<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      

        User::create([
            'name'=> 'Moh.Agung Nursalim',
            'username'=>'Agung21',
            'email'=> 'agungmobeh@gmail.com',
            'password' => bcrypt('password')
        ]);
        User::create([
            'name'=> 'Ridwan Hanif',
            'username' => 'wannn',
            'email'=> 'wan@gmail.com',
            'password' => bcrypt('1234567')
        ]);

        User::factory(3)->create();

        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming'
        ]);

        Category::create([
            'name' => 'Technology',
            'slug' => 'technology'
        ]);

        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design'
        ]);


      
            Post::factory(20)->create();
    }
}
