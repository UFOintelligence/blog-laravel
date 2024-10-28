<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tags = ['laravel', 'vue', 'react'];

        foreach ($tags as $tag){
            \App\Models\Tags::create([
                'name' => $tag,
            ]);

        }
    }
}
