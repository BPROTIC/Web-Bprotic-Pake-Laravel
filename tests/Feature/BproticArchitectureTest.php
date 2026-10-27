<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\ContactMessage;
use App\Models\Department;
use App\Models\DepartmentField;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BproticArchitectureTest extends TestCase
{
    use DatabaseTransactions;

    public function test_public_pages_return_successful_responses(): void
    {
        $this->get('/')->assertStatus(200)->assertSee('BPROTIC');
        $this->get('/tentang-kami')->assertStatus(200);
        $this->get('/departemen')->assertStatus(200)->assertSee('Software Development');
        $this->get('/divisi')->assertRedirect(route('public.departments.index'));
        $this->get('/kegiatan')->assertStatus(200);
        $this->get('/artikel')->assertStatus(200);
        $this->get('/prestasi')->assertStatus(200);
        $this->get('/galeri')->assertStatus(200);
        $this->get('/kontak')->assertStatus(200);
    }

    public function test_contact_form_submission_creates_record_and_redirects(): void
    {
        $response = $this->post('/kontak', [
            'name' => 'John Doe QA',
            'email' => 'johndoe@example.com',
            'phone' => '081234567890',
            'subject' => 'Pertanyaan Kerjasama Workshop',
            'message' => 'Halo pengurus BPROTIC, kami berminat berkolaborasi.',
        ]);

        $response->assertRedirect(route('public.contact'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', [
            'email' => 'johndoe@example.com',
            'subject' => 'Pertanyaan Kerjasama Workshop',
            'is_read' => false,
        ]);
    }

    public function test_draft_activity_cannot_be_accessed_by_public(): void
    {
        $draft = Activity::create([
            'title' => 'Kegiatan Rahasia Internal Draft',
            'slug' => 'kegiatan-rahasia-draft',
            'description' => 'Konten ini masih dalam proses penulisan draft.',
            'is_published' => false,
        ]);

        // Public index should not show draft
        $this->get('/kegiatan')->assertDontSee('Kegiatan Rahasia Internal Draft');

        // Public detail must return 404 Not Found
        $this->get('/kegiatan/' . $draft->slug)->assertStatus(404);
    }

    public function test_guest_is_redirected_when_accessing_admin(): void
    {
        $this->get('/admin/dashboard')
            ->assertRedirect(route('login'));
    }

    public function test_admin_can_login_and_access_dashboard(): void
    {
        $admin = User::where('email', 'admin@bprotic.id')->first();

        $response = $this->post('/login', [
            'email' => 'admin@bprotic.id',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($admin);

        $this->actingAs($admin)->get('/admin/dashboard')->assertStatus(200);
    }

    public function test_admin_can_create_and_delete_activity(): void
    {
        $admin = User::where('email', 'admin@bprotic.id')->first();

        $response = $this->actingAs($admin)->post('/admin/kegiatan', [
            'title' => 'Seminar Kecerdasan Buatan 2026',
            'excerpt' => 'Seminar AI terkini',
            'description' => 'Seminar mendalam mengenai Machine Learning dan LLM.',
            'event_date' => now()->toDateString(),
            'location' => 'Aula Gedung Rektorat UBP',
            'is_published' => 1,
        ]);

        $response->assertRedirect(route('admin.activities.index'));
        $this->assertDatabaseHas('activities', ['title' => 'Seminar Kecerdasan Buatan 2026']);

        $activity = Activity::where('title', 'Seminar Kecerdasan Buatan 2026')->first();

        // Delete activity
        $deleteResponse = $this->actingAs($admin)->delete('/admin/kegiatan/' . $activity->id);
        $deleteResponse->assertRedirect(route('admin.activities.index'));

        $this->assertDatabaseMissing('activities', ['id' => $activity->id]);
    }

    public function test_three_official_departments_structure_and_detail_pages(): void
    {
        // 1. Home page must feature 'Departemen & Bidang Keahlian'
        $home = $this->get('/');
        $home->assertStatus(200);
        $home->assertSee('Departemen & Bidang Keahlian', false);
        $home->assertSee('Software Development Department');
        $home->assertSee('Internet of Things (IoT) Department');
        $home->assertSee('Data Science Department');

        // 2. Software Development page must show Web Dev & Mobile Dev
        $soft = $this->get('/departemen/software-development');
        $soft->assertStatus(200);
        $soft->assertSee('Web Development');
        $soft->assertSee('Mobile Development');

        // 3. IoT page must show the 5 official learning focuses
        $iot = $this->get('/departemen/iot');
        $iot->assertStatus(200);
        $iot->assertSee('Mikrokontroler dan embedded systems');
        $iot->assertSee('Sensor dan aktuator');
        $iot->assertSee('Komunikasi perangkat dan protokol IoT');
        $iot->assertSee('Monitoring perangkat dan pengiriman data');
        $iot->assertSee('Prototyping dan otomasi berbasis IoT');

        // 4. Data Science page must show Data, Machine Learning, and Artificial Intelligence
        $ds = $this->get('/departemen/data-science');
        $ds->assertStatus(200);
        $ds->assertSee('Data');
        $ds->assertSee('Machine Learning');
        $ds->assertSee('Artificial Intelligence (AI)');
    }

    public function test_admin_can_manage_departments_and_child_fields(): void
    {
        $admin = User::where('email', 'admin@bprotic.id')->first();
        $dept = Department::where('slug', 'software-development')->first();

        // Admin can add a new child field under Software Development
        $response = $this->actingAs($admin)->post('/admin/departemen/' . $dept->id . '/bidang', [
            'name' => 'DevOps & Cloud Engineering',
            'description' => 'Infrastruktur cloud dan CI/CD automation.',
            'order' => 9,
            'is_active' => 1,
        ]);

        $response->assertRedirect(route('admin.departments.edit', $dept));
        $this->assertDatabaseHas('department_fields', [
            'department_id' => $dept->id,
            'name' => 'DevOps & Cloud Engineering',
        ]);

        $field = DepartmentField::where('name', 'DevOps & Cloud Engineering')->first();

        // Admin can update child field
        $updateResp = $this->actingAs($admin)->put('/admin/departemen/bidang/' . $field->id, [
            'name' => 'DevOps & Cloud Security',
            'description' => 'Infrastruktur cloud terenkripsi.',
            'order' => 10,
            'is_active' => 1,
        ]);
        $updateResp->assertRedirect(route('admin.departments.edit', $dept));
        $this->assertDatabaseHas('department_fields', ['id' => $field->id, 'name' => 'DevOps & Cloud Security']);

        // Admin can delete child field without affecting parent department
        $deleteResp = $this->actingAs($admin)->delete('/admin/departemen/bidang/' . $field->id);
        $deleteResp->assertRedirect(route('admin.departments.edit', $dept));
        $this->assertDatabaseMissing('department_fields', ['id' => $field->id]);
        $this->assertDatabaseHas('departments', ['id' => $dept->id]);
    }
}
