<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Article;
use App\Models\Category;
use App\Models\Portfolio;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(User::class, 10)->create();
        factory(Product::class, 20)->create();
        factory(Category::class, 8)->create();
        factory(Portfolio::class, 8)->create();
        factory(Article::class, 30)->create();
    }
}
