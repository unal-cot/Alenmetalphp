<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use App\Models\Media;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteConfig;
use App\Models\Stat;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@alenmetal.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@alenmetal.com',
                'password' => Hash::make('admin123'),
                'role' => 'ADMIN',
            ]
        );

        // Services
        $services = [
            ['title' => 'Personel Panel Çit Kapı', 'description' => 'Yaya geçişleri için özel olarak tasarlanmış, dayanıklı ve estetik personel panel çit kapı sistemleri. Galvanizli çelik profillerden üretilen kapılarımız, yoğun kullanım alanlarında uzun ömürlü çözümler sunar.', 'icon' => 'fence', 'features' => 'Yüksek dayanıklılık, Kolay geçiş, Estetik tasarım, Uzun ömür', 'order' => 0],
            ['title' => 'Sürgülü Panel Çit Kapı', 'description' => 'Geniş açıklıklar için ideal, raylı sistem üzerinde sessiz ve güvenli hareket eden sürgülü panel çit kapılar. Endüstriyel tesisler, siteler ve özel mülkler için profesyonel çözümler.', 'icon' => 'door_sliding', 'features' => 'Sessiz hareket, Raylı sistem, Geniş açıklık, Otomasyon uyumlu', 'order' => 1],
            ['title' => 'Sürgülü Panjur Kapı', 'description' => 'Yüksek güvenlikli sürgülü panjur kapı sistemlerimiz, işyerleri ve endüstriyel alanlar için maksimum koruma sağlar. Sağlam çelik panjur profilleri ve güçlendirilmiş ray mekanizmasıyla uzun yıllar güvenle kullanılır.', 'icon' => 'garage_door', 'features' => 'Yüksek güvenlik, Çelik profil, Motorlu sistem, Dayanıklı yapı', 'order' => 2],
            ['title' => 'Personel Panjur Kapı', 'description' => 'Yaya geçişleri için tasarlanmış, kompakt ve güvenli personel panjur kapı sistemleri. Mağaza, ofis ve apartman girişlerinde estetik görünümü ve pratik kullanımı bir arada sunar.', 'icon' => 'door_front', 'features' => 'Kompakt tasarım, Pratik kullanım, Estetik görünüm, Güvenli geçiş', 'order' => 3],
            ['title' => 'Panjur Sistemleri', 'description' => 'Ticari ve endüstriyel mekanlar için komple panjur sistemleri çözümleri. Manuel ve motorlu seçenekleri, özel ölçü ve renk alternatifleriyle ihtiyacınıza uygun panjur sistemleri kuruyoruz.', 'icon' => 'roller_shades', 'features' => 'Manuel / Motorlu, Özel ölçü, Renk seçeneği, Profesyonel montaj', 'order' => 4],
            ['title' => 'Panel Çit', 'description' => 'Estetik ve sağlam panel çit sistemleri ile güvenliği en üst seviyeye çıkarıyoruz. Modern tasarımı ve üstün mukavemetiyle panel çitlerimiz, endüstriyel tesislerden toplu konut projelerine kadar geniş bir kullanım alanına sahiptir.', 'icon' => 'grid_on', 'features' => 'Modern estetik, Yüksek güvenlik, Uzun ömür, Bakım gerektirmez', 'order' => 5],
            ['title' => 'Çim Çit', 'description' => 'Doğal görünüm sunan çim çit sistemleri ile estetik ve mahremiyet sağlar. Çevre dostu malzemelerden üretilen çim çitlerimiz, bahçe ve peyzaj alanlarında doğal bir görünüm elde etmenizi sağlar.', 'icon' => 'grass', 'features' => 'Doğal görünüm, Mahremiyet, Çevre dostu, Kolay bakım', 'order' => 6],
            ['title' => 'İnşaat Çevre Kapama', 'description' => 'Şantiye ve inşaat alanlarınız için güvenli ve dayanıklı çevre kapama sistemleri kuruyoruz. Hızlı kurulum ve ekonomik çözümlerle projelerinizi güvence altına alıyoruz.', 'icon' => 'construction', 'features' => 'Hızlı kurulum, Dayanıklı malzeme, Ekonomik fiyat, Projeye özel çözüm', 'order' => 7],
            ['title' => 'Muhtelif Kaynak İşleri', 'description' => 'Profesyonel kaynak hizmetlerimizle metal yapılarınızı güçlendiriyoruz. Demir, çelik ve alüminyum kaynak işlemlerinde uzman ekibimizle hizmetinizdeyiz.', 'icon' => 'build', 'features' => 'Sertifikalı kaynakçı, Her tür metal, Yerinde servis, Kalite garantisi', 'order' => 8],
            ['title' => 'Desenli Çit', 'description' => 'Dekoratif desenli çit sistemlerimizle güvenliği estetikle buluşturuyoruz. Farklı desen seçenekleriyle mekanlarınıza özgün bir görünüm kazandırıyoruz.', 'icon' => 'grid_view', 'features' => 'Dekoratif tasarım, Yüksek dayanıklılık, Çeşitli desen seçeneği, Kolay montaj', 'order' => 9],
        ];
        Service::query()->delete();
        foreach ($services as $s) {
            Service::create($s);
        }

        // Stats
        $stats = [
            ['label' => 'Tamamlanan Proje', 'value' => '500+', 'order' => 0],
            ['label' => 'Yıllık Tecrübe', 'value' => '10+', 'order' => 1],
            ['label' => 'Mutlu Müşteri', 'value' => '1000+', 'order' => 2],
        ];
        Stat::query()->delete();
        foreach ($stats as $s) {
            Stat::create($s);
        }

        // Projects
        $projects = [
            ['title' => 'Modern Sürgülü Çit Kapı', 'description' => 'Lüks rezidans için otomatik sürgülü panel çit kapı', 'category' => 'Sürgülü Panel Çit Kapı', 'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA353CKxl5bI0gk8uvabHaHTch4K72ByMLEZtAsIsooGwaJlqIdn0iAugUYqzeu1s9Y1CgQd86iEsk2o7OMgSVuI02EbbQHe-JKzwvBRrYPWffROa7a05dTNn1jX_b6djUWun45oYYy2HCLUMkF7hWgimsbYP9nSVr-9S5l6JsUCRts9RxuM_1-QAgJGtjYlwnNf1N0yTxGN0P7aiRb6ax4NsZphF268zOcUJdGU0YYp43kQahbklMRbzovTem12ZjOxKkJt0DKYSEL'],
            ['title' => 'Panel Çit Kapı Montajı', 'description' => 'Endüstriyel tesis çevresi personel panel çit kapı', 'category' => 'Personel Panel Çit Kapı', 'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCgCTYOaY27eGmba0CfkVJYwS7pOlBzjYb3SzMerG8pBgHs6dnCk4-H1ggFwN6hzSUZbdNuVTloO-DtCteFQC8lSwDswE6ib6ivOeSMe8o1z7uWO12RZ19zhn88l0JabQq1qy98FURWeTX63n_StKXd8Oe-8O2I_cLS8NbYXFLpcXwmR76XboRGSBgusWywXBY7KTyqMK5Py4IbsBZnqF-2tw5xxjIIQp3t8YWVQn2xM3dnnpxNsICtPAvdIZb04fLbfnEH59eR0QyM'],
            ['title' => 'Toplu Konut Panel Çit', 'description' => 'Modern toplu konut panel çit kapı sistemi', 'category' => 'Personel Panel Çit Kapı', 'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuD2yHkVZyuv0T_9_J7jUk3a0RZYJ2YO8yQbpJxkwpF3oWuighARRZIDNUAAmdfmlytyWHY1cDog54Fpu2WZsmtWwux99BbffIkVozimVzfmctAhr8fD3sCAPNpwATnolX4BKCJP37mvk5STdeiL3hOwNTOts0LRwN80apPbqZ1IpGOx-m7-g9Ub9cTIpIYjl2kxGihiWKadbdgq5e2mZ3KVwCXJNhtGx53E69YGO1E-alp7nD5T_sJbaxSb11t4rG4aUGNKv7d8eH1k'],
            ['title' => 'Panjur Kapı Kurulumu', 'description' => 'İşyeri için yüksek güvenlikli sürgülü panjur kapı', 'category' => 'Sürgülü Panjur Kapı', 'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDuTROix_n2P1VI1zuFgHWWG5mkWAu8SLvBOov0Unqrg2-vKruWWgji4BpaSCc6jOXI3J3O7AGwAnEqaYjoUe0n3PGsm92CmgwQqXZR5U49-M6tnszck7Lds4v1QqGBzvfhgTKsePaTKKjsRhEyT67G7bDoSpEMFkFj3U5SFvEj9OJtufNvC93BSMYgp9q7QnZC4rZHANi213PapXHbFu9SzDXrumx0hT83rLrQjSQ4qB4Ot-1NQVCQtaDQAKkdW6s6-ZMjjNbucqjZ'],
            ['title' => 'Motorlu Panjur Sistemi', 'description' => 'Endüstriyel tesis için ağır yük motorlu panjur', 'category' => 'Panjur Sistemleri', 'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBcJx5QZ4i0pSIttr8N0BzBqLxv2ZVNMn6w6ENWQfYgjAODIU4RQ4q4aUPAxj2i6DFp8Ob0aJm1MnXRq7UtQhwSjKBS7XlOFEB1yN-itsKUFOkR7W-NhuB2j3TBNWn9GtlZkBPF9XXhAHERKoA6xtKvsNts9bTqoLYJE58f5GQMjVCPbJjQ-_qQqkzL22ZQK2C9HxlNP5t3dNq3TkVGHNkFqMA5Q5t8WYkG8Z2FNUpMJYYYmpvE5Y9sMGMCFjYXtQr6RBFX'],
            ['title' => 'Personel Panjur Kapı', 'description' => 'Ofis girişi için kompakt personel panjur kapı', 'category' => 'Personel Panjur Kapı', 'image_url' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC9TJH8Lf3RcTkHGhUOwX8XmNhZq0VbZC5JbC4aVkHksLlNIq0YVqYqT6GYcJ5FJKL0G0Fs6W7k1mVhHDoKUtpR2sX2aFY6nJ0q0sYvDdKuI6XbCvYQzI1eF01MkQ0Q-V8fhOlVzLdPjk0X3I2CN8wEmcrZN3l7dG-xSqkyrKmC_V'],
        ];
        Project::query()->delete();
        foreach ($projects as $p) {
            Project::create($p);
        }

        // Site config
        $configs = [
            ['key' => 'tagline', 'value' => 'Güvenlikte Kalite, İşte Güç!'],
            ['key' => 'hero_description', 'value' => 'Metal gücümüz ve tecrübemizle, yaşam alanlarınız için güvenli çözümler üretiyoruz. Dayanıklılık ve estetiği bir araya getiren premium uygulamalar.'],
            ['key' => 'hero_image_url', 'value' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA353CKxl5bI0gk8uvabHaHTch4K72ByMLEZtAsIsooGwaJlqIdn0iAugUYqzeu1s9Y1CgQd86iEsk2o7OMgSVuI02EbbQHe-JKzwvBRrYPWffROa7a05dTNn1jX_b6djUWun45oYYy2HCLUMkF7hWgimsbYP9nSVr-9S5l6JsUCRts9RxuM_1-QAgJGtjYlwnNf1N0yTxGN0P7aiRb6ax4NsZphF268zOcUJdGU0YYp43kQahbklMRbzovTem12ZjOxKkJt0DKYSEL'],
            ['key' => 'contact_name_1', 'value' => 'Ali Berkant Karabulut'],
            ['key' => 'phone_1', 'value' => '0530 845 1754'],
            ['key' => 'contact_name_2', 'value' => 'Engin TOPGÜL'],
            ['key' => 'phone_2', 'value' => '0541 204 2908'],
            ['key' => 'footer_description', 'value' => 'Güçlü Yapılar, Güvenli Yarınlar.'],
            ['key' => 'about_intro', 'value' => 'ALEN METAL olarak, metal sektöründe yılların getirdiği tecrübe ile güvenlik ve dayanıklılıkta kalite standardını belirliyoruz.'],
            ['key' => 'mission_text', 'value' => 'Müşterilerimize en kaliteli metal ürünlerini ve güvenlik çözümlerini sunarak, yaşam alanlarını daha güvenli ve estetik hale getirmek. Teknoloji ve işçiliği birleştirerek sektörde öncü olmak.'],
            ['key' => 'vision_text', 'value' => 'Türkiye\'nin lider metal ve güvenlik sistemleri markası olarak, uluslararası standartlarda üretim yapmak ve global pazarda söz sahibi olmak. Sürdürülebilir büyüme ile sektöre yön vermek.'],
            ['key' => 'address', 'value' => 'İstanbul, Türkiye'],
            ['key' => 'map_query', 'value' => 'İstanbul, Türkiye'],
            ['key' => 'copyright', 'value' => '© 2024 Alen Metal. Güçlü Yapılar, Güvenli Yarınlar.'],
        ];
        foreach ($configs as $c) {
            SiteConfig::updateOrCreate(['key' => $c['key']], ['value' => $c['value']]);
        }

        echo "Seed completed!\n";
    }
}
