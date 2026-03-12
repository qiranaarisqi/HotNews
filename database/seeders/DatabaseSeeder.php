<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Tag;
use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin News',
            'email' => 'admin@news.com',
            'password' => Hash::make('password'),
            'role' => 'ADMIN',
            'created_at' => now(),
        ]);

        // Categories
        $categories = ['Politik', 'Sport', 'Teknologi', 'Entertainment', 'Dunia'];
        foreach ($categories as $cat) {
            Kategori::create([
                'name' => $cat,
                'description' => "Berita seputar $cat",
                'created_at' => now(),
            ]);
        }

        // Tags
        $tags = ['Trending', 'Breaking', 'Viral', 'Update', 'Hot', 'Popular', 'New', 'Features', 'Exclusive', 'Daily'];
        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
            ]);
        }

        // Articles
        $userId = User::first()->id_user;
        $categoryIds = Kategori::pluck('id_kategori')->toArray();
        $tagIds = Tag::pluck('id_tags')->toArray();

        for ($i = 1; $i <= 20; $i++) {
            $catId = $categoryIds[array_rand($categoryIds)];
            $article = Article::create([
                'title' => "Berita Utama Hari Ini Ke-$i",
                'slug' => "berita-utama-hari-ini-$i",
                'content' => "Ini adalah konten berita utama ke-$i. Portal berita yang selalu up to date setiap berita yang terbaru.",
                'image' => "https://picsum.photos/seed/news$i/800/600",
                'status' => 'published',
                'views' => rand(10, 500),
                'id_user' => $userId,
                'id_kategori' => $catId,
                'created_at' => now()->subHours(rand(1, 48)),
                'updated_at' => now(),
            ]);

            // Random tags
            $randomTags = array_rand(array_flip($tagIds), rand(1, 3));
            if (!is_array($randomTags)) $randomTags = [$randomTags];
            $article->tags()->attach($randomTags);
        }
    }
}
