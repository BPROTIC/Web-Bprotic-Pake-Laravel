<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Activity;
use App\Models\Article;
use App\Models\Department;
use App\Models\DepartmentField;
use App\Models\Division;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
 
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Default Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@bprotic.id'],
            [
                'name' => 'Administrator BPROTIC',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        // 2. Default Website Settings
        $settings = [
            'site_name' => 'UKM BPROTIC UBP Karawang',
            'site_tagline' => 'Buana Perjuangan University Robotics Club',
            'site_description' => 'Wadah pengembangan minat, bakat, riset teknologi di bidang pemrograman, robotika, dan teknologi informasi Universitas Buana Perjuangan Karawang.',
            'site_email' => 'ukm.bprotic@ubpkarawang.ac.id',
            'site_phone' => '+62 812-3456-7890',
            'site_address' => 'Gedung Ormawa Kampus UBP Karawang, Jl. HS. Ronggowaluyo, Telukjambe Timur, Karawang, Jawa Barat 41361',
            'social_instagram' => 'https://instagram.com/bprotic_ubp',
            'social_youtube' => 'https://youtube.com/@bproticubp',
            'social_linkedin' => 'https://linkedin.com/company/bprotic-ubp',
            'social_github' => 'https://github.com/bprotic-ubp',
            'commerce_whatsapp' => '',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }

        Product::updateOrCreate(
            ['slug' => 'pdh-bprotic'],
            [
                'name' => 'PDH BPROTIC',
                'type' => 'physical',
                'availability' => 'preorder',
                'description' => 'PDH resmi BPROTIC. Hubungi pengurus melalui WhatsApp untuk informasi ukuran dan pemesanan.',
                'price' => 130000,
                'preorder_ends_at' => null,
                'production_estimate' => null,
                'is_published' => true,
            ]
        );

        // 3. Official 3 Departments of BPROTIC & Fields of Expertise
        $deptSoftware = Department::updateOrCreate(
            ['slug' => 'software-development'],
            [
                'name' => 'Software Development Department',
                'short_description' => 'Departemen berfokus pada pengembangan aplikasi web dan mobile modern berbasis hands-on learning dan project nyata siap industri.',
                'description' => 'Departemen Software Development berfokus pada pengembangan kemampuan anggota dalam bidang pembuatan perangkat lunak, mencakup pengembangan aplikasi berbasis web dan mobile, mulai dari dasar pemrograman hingga implementasi teknologi modern. Menggunakan pendekatan hands-on learning, setiap materi langsung diaplikasikan dalam bentuk project nyata. Pembelajaran dirancang agar anggota tidak hanya memahami konsep, tetapi juga mampu membangun aplikasi yang terstruktur, terintegrasi, dan siap digunakan. Departemen ini mencakup dua divisi utama yaitu Web Development dan Mobile Development, yang saling terhubung dalam proses pengembangan aplikasi secara end-to-end, menyerupai alur kerja di dunia industri.',
                'learning_focus' => "Menyelenggarakan pembelajaran terstruktur berbasis praktik (hands-on learning)\nMengembangkan kemampuan anggota melalui project nyata berbasis studi kasus\nMendorong setiap anggota memiliki portofolio digital sebagai bukti kompetensi\nMenyelenggarakan kegiatan publik seperti workshop dan expo sebagai sarana berbagi ilmu\nMembangun lingkungan belajar yang kolaboratif dan adaptif terhadap perkembangan teknologi",
                'technologies' => 'PHP, Laravel, MySQL, REST API, Postman, Git & GitHub, TypeScript, React Native, Expo, Ionic, Tailwind CSS, Docker',
                'icon' => 'code',
                'order' => 1,
                'is_active' => true,
            ]
        );

        DepartmentField::updateOrCreate(
            ['department_id' => $deptSoftware->id, 'slug' => 'web-development'],
            [
                'name' => 'Web Development',
                'description' => 'Fokus pada pengembangan aplikasi web dan sistem backend: mulai dari fundamental logika PHP, arsitektur OOP & MVC, framework Laravel, hingga perancangan RESTful API terintegrasi yang siap dikonsumsi oleh aplikasi mobile.',
                'icon' => 'globe',
                'order' => 1,
                'is_active' => true,
            ]
        );

        DepartmentField::updateOrCreate(
            ['department_id' => $deptSoftware->id, 'slug' => 'mobile-development'],
            [
                'name' => 'Mobile Development',
                'description' => 'Fokus pada pengembangan aplikasi mobile multi-platform: perancangan antarmuka responsif, state management, integrasi REST API backend, penyimpanan lokal, hingga build dan distribusi file APK Android.',
                'icon' => 'device-phone',
                'order' => 2,
                'is_active' => true,
            ]
        );

        // Department B: Internet of Things (IoT) Department
        // Catatan: Tidak membuat bidang buatan; menampilkan 5 fokus pembelajaran resmi
        Department::firstOrCreate(
            ['slug' => 'iot'],
            [
                'name' => 'Internet of Things (IoT) Department',
                'short_description' => 'Departemen yang berfokus pada integrasi perangkat keras, sensor, mikrokontroler, dan perangkat lunak untuk membangun sistem yang saling terhubung.',
                'description' => 'Internet of Things (IoT) Department membekali anggota dengan keahlian komprehensif dalam menghubungkan dunia fisik dengan dunia komputasi digital melalui sensor, mikrokontroler terintegrasi, dan jaringan komunikasi cerdas.',
                'learning_focus' => "Mikrokontroler dan embedded systems.\nSensor dan aktuator.\nKomunikasi perangkat dan protokol IoT.\nMonitoring perangkat dan pengiriman data.\nPrototyping dan otomasi berbasis IoT.",
                'technologies' => 'Arduino IDE, ESP32, ESP8266, Raspberry Pi, MQTT, HTTP/REST, C/C++, Python, FreeRTOS, LoRaWAN, Node-RED, Sensors & Actuators',
                'icon' => 'cpu',
                'order' => 2,
                'is_active' => true,
            ]
        );

        // Department C: Data Science Department
        $deptData = Department::firstOrCreate(
            ['slug' => 'data-science'],
            [
                'name' => 'Data Science Department',
                'short_description' => 'Departemen yang berfokus pada pengolahan data, analisis, dan pengembangan sistem kecerdasan buatan.',
                'description' => 'Data Science Department berdedikasi membimbing mahasiswa dalam mengeksplorasi ekstraksi nilai strategis dari data, perancangan model prediktif statistik, pembelajaran mesin cerdas, dan implementasi Artificial Intelligence pada berbagai skenario riil.',
                'learning_focus' => "Pengumpulan, pembersihan, dan analisis dataset eksploratif\nPengembangan model prediksi dan pembelajaran mesin (Machine Learning)\nPerancangan solusi cerdas berbasis Artificial Intelligence\nVisualisasi data interaktif dan business intelligence\nPenerapan deep learning pada visi komputer & Natural Language Processing",
                'technologies' => 'Python, R, Pandas, NumPy, Scikit-Learn, TensorFlow, PyTorch, Jupyter Notebook, Power BI, SQL, OpenCV, HuggingFace',
                'icon' => 'chart-bar',
                'order' => 3,
                'is_active' => true,
            ]
        );

        DepartmentField::firstOrCreate(
            ['department_id' => $deptData->id, 'slug' => 'data'],
            [
                'name' => 'Data',
                'description' => 'Pengolahan data, data analytics, visualisasi data, dan pengelolaan dataset.',
                'icon' => 'database',
                'order' => 1,
                'is_active' => true,
            ]
        );

        DepartmentField::firstOrCreate(
            ['department_id' => $deptData->id, 'slug' => 'machine-learning'],
            [
                'name' => 'Machine Learning',
                'description' => 'Pengembangan model prediksi dan sistem pembelajaran mesin.',
                'icon' => 'sparkles',
                'order' => 2,
                'is_active' => true,
            ]
        );

        DepartmentField::firstOrCreate(
            ['department_id' => $deptData->id, 'slug' => 'artificial-intelligence'],
            [
                'name' => 'Artificial Intelligence (AI)',
                'description' => 'Pengembangan solusi AI, intelligent systems, dan penerapan teknologi kecerdasan buatan.',
                'icon' => 'brain',
                'order' => 3,
                'is_active' => true,
            ]
        );

        // 4. Default Activities
        $activities = [
            [
                'title' => 'BPROTIC Tech Camp & Pengkaderan 2026',
                'slug' => 'bprotic-tech-camp-2026',
                'excerpt' => 'Pelatihan intensif teknologi dan pembentukan karakter kepemimpinan anggota baru BPROTIC UBP Karawang.',
                'description' => 'BPROTIC Tech Camp merupakan agenda tahunan yang menggabungkan pembekalan hardskill (coding & elektronika dasar) dengan penguatan solidaritas, kepemimpinan, dan etika riset teknologi.',
                'event_date' => now()->addDays(14)->format('Y-m-d'),
                'location' => 'Auditorium UBP Karawang & Kampus B',
                'is_published' => true,
            ],
            [
                'title' => 'Workshop National: Menguasai Modern Fullstack Laravel 13',
                'slug' => 'workshop-fullstack-laravel-13',
                'excerpt' => 'Pelatihan praktis membangun aplikasi berbasis web modern dengan standar industri dan clean code.',
                'description' => 'Diselenggarakan bekerja sama dengan praktisi industri, membimbing mahasiswa mulai dari arsitektur database, RESTful API, hingga integrasi antarmuka yang cepat dan responsif.',
                'event_date' => now()->subDays(10)->format('Y-m-d'),
                'location' => 'Laboratorium Komputer 3 UBP Karawang',
                'is_published' => true,
            ],
            [
                'title' => 'UBP Karawang Cyber CTF Challenge 2026',
                'slug' => 'ubp-karawang-cyber-ctf-2026',
                'excerpt' => 'Kompetisi internal dan regional keamanan siber untuk menguji ketangkasan reverse engineering dan kriptografi.',
                'description' => 'Ajang kompetisi tahunan yang menguji ketahanan dan kemampuan berpikir kritis mahasiswa dalam memecahkan skenario keamanan jaringan, web exploitation, dan analisis forensik digital.',
                'event_date' => now()->addDays(30)->format('Y-m-d'),
                'location' => 'Online Platform & Ruang Serbaguna Lt. 4',
                'is_published' => true,
            ],
        ];

        foreach ($activities as $act) {
            Activity::firstOrCreate(['slug' => $act['slug']], $act);
        }

        // 5. Default Articles
        $articles = [
            [
                'title' => 'Mengenal Tren Robotika dan IoT di Lingkungan Akademis',
                'slug' => 'mengenal-tren-robotika-dan-iot',
                'category' => 'Teknologi',
                'excerpt' => 'Bagaimana perkembangan embedded system dan mikrokontroler membuka peluang riset mahasiswa di era industri 4.0.',
                'content' => 'Perkembangan Internet of Things (IoT) tidak lagi sekadar wacana teoritis. Mahasiswa teknik dan ilmu komputer di UBP Karawang kini memanfaatkan mikrokontroler berbasis WiFi dan LoRa untuk menciptakan solusi nyata, mulai dari smart agriculture hingga monitoring kualitas lingkungan kampus.',
                'author_id' => $admin->id,
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Kiat Menjadi Web Developer Kompeten dari Bangku Kuliah',
                'slug' => 'kiat-menjadi-web-developer-kompeten',
                'category' => 'Edukasi',
                'excerpt' => 'Langkah-langkah strategis membangun portofolio pemrograman sejak semester awal kuliah.',
                'content' => 'Memulai perjalanan di dunia pengembangan software membutuhkan konsistensi dan proyek nyata. Melalui kelompok belajar di UKM BPROTIC, anggota dibimbing untuk memahami fundamental algoritma, version control Git, serta metodologi kolaborasi tim yang dipakai di industri teknologi global.',
                'author_id' => $admin->id,
                'is_published' => true,
                'published_at' => now()->subDays(12),
            ],
        ];

        foreach ($articles as $art) {
            Article::firstOrCreate(['slug' => $art['slug']], $art);
        }

        // 6. Default Achievements
        $achievements = [
            [
                'title' => 'Juara 1 Lomba Inovasi Teknologi IoT Jawa Barat',
                'category' => 'Regional',
                'recipient' => 'Tim Riset BPROTIC (Farras dkk)',
                'event_date' => now()->subMonths(2)->format('Y-m-d'),
                'description' => 'Meraih juara pertama dengan karya sistem irigasi otomatis berbasis LoRaWAN dan dashboard monitoring cerdas.',
                'is_published' => true,
            ],
            [
                'title' => 'Top 5 Finalis Capture The Flag Nasional 2025',
                'category' => 'Nasional',
                'recipient' => 'BPRO-Cyber Squad',
                'event_date' => now()->subMonths(4)->format('Y-m-d'),
                'description' => 'Berhasil menembus babak final 5 besar tingkat nasional bersaing dengan perguruan tinggi ternama seluruh Indonesia.',
                'is_published' => true,
            ],
        ];

        foreach ($achievements as $ach) {
            Achievement::firstOrCreate(['title' => $ach['title']], $ach);
        }

        // 7. Default Galleries
        $galleries = [
            [
                'title' => 'Pelantikan & Rapat Kerja Kepengurusan BPROTIC',
                'category' => 'Organisasi',
                'description' => 'Momen pelantikan pengurus baru BPROTIC periode 2026 dihadiri pimpinan rektorat UBP Karawang.',
                'image' => 'asetss/logo bprotic.png',
                'event_date' => now()->subMonths(1)->format('Y-m-d'),
                'is_published' => true,
            ],
            [
                'title' => 'Sesi Praktikum Perakitan Robot Line Follower',
                'category' => 'Workshop',
                'description' => 'Anggota divisi robotika sedang melakukan kalibrasi sensor photodioda pada sirkuit perlombaan.',
                'image' => 'asetss/logo bprotic.png',
                'event_date' => now()->subDays(20)->format('Y-m-d'),
                'is_published' => true,
            ],
        ];

        foreach ($galleries as $gal) {
            Gallery::firstOrCreate(['title' => $gal['title']], $gal);
        }

        // 8. Default Pages (Tentang Kami)
        Page::updateOrCreate(
            ['slug' => 'tentang-kami'],
            [
                'title' => 'Tentang UKM BPROTIC UBP Karawang',
                'content' => "Unit Kegiatan Mahasiswa Buana Perjuangan University Robotics Club (UKM BPROTIC) didirikan sebagai wadah riset terapan, inovasi rekayasa perangkat lunak, dan teknologi otomasi bagi mahasiswa Universitas Buana Perjuangan Karawang. Berdiri di tengah pesatnya kota industri terbesar di Indonesia, BPROTIC berkomitmen mencetak talenta masa depan yang siap bersaing di kancah nasional maupun internasional.\n\n1. Latar Belakang dan Awal Pendirian (2016)\nUniversitas Buana Perjuangan (UBP) Karawang resmi mendapatkan izin berdiri pada akhir tahun 2014 dan mulai aktif menyelenggarakan perkuliahan pada tahun 2015. Sebagai perguruan tinggi di kawasan industri strategis, kebutuhan mahasiswa akan ruang riset teknologi terapan sangatlah tinggi. Menjawab peluang tersebut, sekelompok mahasiswa perintis dari bidang Teknik Informatika dan Sistem Informasi menginisiasi pendirian klub robotika kampus bernama resmi Buana Perjuangan University Robotics Club (BPROTIC) pada tahun 2016. Misi awalnya berfokus meruntuhkan stigma bahwa merakit robot itu rumit dan mahal, sekaligus membuka panggung kompetitif bagi mahasiswa Karawang di kancah teknologi nasional.\n\n2. Budaya \"Sabtu Ngoprek\" dan Basis Laboratorium (2017)\nPada fase awal perintisan, keterbatasan alat dan komponen elektronika disiasati melalui solidaritas dan etos kerja riset yang kuat. Bermarkas di ruang laboratorium Lantai 2 Kampus UBP Karawang, BPROTIC menginisiasi agenda rutin legendaris bernama \"Sabtu Ngoprek\". Setiap akhir pekan dari pagi hingga sore hari, para anggota berkumpul untuk membedah mikrokontroler, melatih presisi penyolderan sirkuit, hingga mempelajari logika pemrograman mikrokontroler secara intensif dan kolaboratif.\n\n3. Fase Pembelajaran Sensor dan Otomatisasi (2018)\nMemasuki tahun 2018, spektrum riset BPROTIC melangkah lebih jauh melampaui perakitan robot Line Follower dasar menuju eksplorasi sensor aplikatif industri dan smart living. Proyek-proyek terapan mulai dikembangkan secara masif, seperti pemanfaatan Ultrasonic Sensor untuk navigasi penghindar rintangan (obstacle avoidance), perancangan Raindrops Detector untuk sistem hunian pintar (smart home), serta eksperimen 7-Segment Display berbasis mikrokontroler Arduino untuk instrumentasi perhitungan digital otomatis.\n\n4. Transformasi Multidisiplin dan Masa Depan BPROTIC (2022 - Sekarang)\nSeiring perkembangan kampus UBP Karawang dengan berdirinya Fakultas Ilmu Komputer serta kehadiran Program Studi Teknik Mesin, BPROTIC bertransformasi menjadi UKM riset kolaboratif lintas disiplin ilmu. Sinergi tercipta secara harmonis: mahasiswa teknik mesin merancang struktur mekanik dan hardware presisi, sedangkan mahasiswa rumpun informatika menyuntikkan algoritma kecerdasan buatan dan integrasi software cerdas. Kini, BPROTIC konsisten menjadi inkubator generasi muda UBP Karawang dalam menguasai Embedded Systems, Internet of Things (IoT), pengembangan software modern, hingga persiapan berkesinambungan menuju Kontes Robot Indonesia (KRI).",
                'is_published' => true,
            ]
        );
    }
}
