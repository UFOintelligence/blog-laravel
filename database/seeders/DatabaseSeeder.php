<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


         \App\Models\User::factory()->create([
             'name' => 'Ramon Brito',
            'email' => 'ramonbrito10592@gmail.com',
            'password' => bcrypt('11111111')
         ]);

         \App\Models\User::factory(20)->create();
         \App\Models\Category::factory(15)->create();
         \App\Models\Post::factory(100)->create();

         $this->call(TagSeeder::class);



    }
}
