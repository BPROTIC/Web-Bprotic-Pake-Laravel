<?php

namespace Tests\Feature;

use App\Models\Achievement;
use App\Models\Activity;
use App\Models\Article;
use App\Models\ContactMessage;
use App\Models\Department;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdminModalsTest extends TestCase
{
    use DatabaseTransactions;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::where('email', 'admin@bprotic.id')->first()
            ?? User::factory()->create(['email' => 'admin@bprotic.id', 'role' => 'admin']);
    }

    public function test_all_admin_crud_index_pages_load_with_modals_and_datatables(): void
    {
        // 1. Users module
        $respUser = $this->actingAs($this->admin)->get(route('admin.users.index'));
        $respUser->assertStatus(200);
        $respUser->assertSee('createUserModal');
        $respUser->assertSee('editUserModal');
        $respUser->assertSee('admin-datatable');

        // 2. Galleries module
        $respGallery = $this->actingAs($this->admin)->get(route('admin.galleries.index'));
        $respGallery->assertStatus(200);
        $respGallery->assertSee('createGalleryModal');
        $respGallery->assertSee('editGalleryModal');
        $respGallery->assertSee('admin-datatable');

        // 3. Achievements module
        $respAchievement = $this->actingAs($this->admin)->get(route('admin.achievements.index'));
        $respAchievement->assertStatus(200);
        $respAchievement->assertSee('createAchievementModal');
        $respAchievement->assertSee('editAchievementModal');
        $respAchievement->assertSee('admin-datatable');

        // 4. Activities module
        $respActivity = $this->actingAs($this->admin)->get(route('admin.activities.index'));
        $respActivity->assertStatus(200);
        $respActivity->assertSee('createActivityModal');
        $respActivity->assertSee('editActivityModal');
        $respActivity->assertSee('admin-datatable');

        // 5. Articles module
        $respArticle = $this->actingAs($this->admin)->get(route('admin.articles.index'));
        $respArticle->assertStatus(200);
        $respArticle->assertSee('createArticleModal');
        $respArticle->assertSee('editArticleModal');
        $respArticle->assertSee('admin-datatable');

        // 6. Pages module
        $respPage = $this->actingAs($this->admin)->get(route('admin.pages.index'));
        $respPage->assertStatus(200);
        $respPage->assertSee('createPageModal');
        $respPage->assertSee('editPageModal');
        $respPage->assertSee('admin-datatable');

        // 7. Departments module
        $respDept = $this->actingAs($this->admin)->get(route('admin.departments.index'));
        $respDept->assertStatus(200);
        $respDept->assertSee('createDepartmentModal');
        $respDept->assertSee('editDepartmentModal');
        $respDept->assertSee('manageFieldsModal');
        $respDept->assertSee('admin-datatable');

        // 8. Contact Messages module
        $respMsg = $this->actingAs($this->admin)->get(route('admin.contact-messages.index'));
        $respMsg->assertStatus(200);
        $respMsg->assertSee('viewMessageModal');
        $respMsg->assertSee('admin-datatable');

        // 9. Products module
        $respProduct = $this->actingAs($this->admin)->get(route('admin.products.index'));
        $respProduct->assertStatus(200);
        $respProduct->assertSee('createProductModal');
        $respProduct->assertSee('editProductModal');
        $respProduct->assertSee('admin-datatable');
    }
}
