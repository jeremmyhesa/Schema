<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tournament;
use App\Models\Category;

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
                'name' => 'Jeremmy Hesa',
                'username' => 'jeremmyhs',
                'email' => 'jeremmyhesa10@gmail.com',
                'password' => bcrypt('admin123')
            ]);
            
            // User::create([
                //     'name' => 'Atika Istiqomah',
                //     'email' => 'atikaistiqomah@gmail.com',
                //     'password' => bcrypt('admin123')
                // ]);

        User::factory(5)->create();
                
        Category::create([
            'name' => 'Mobile Legends',
            'slug' => 'mobile-legends'
        ]);

        Category::create([
            'name' => 'FIFA 23',
            'slug' => 'fifa-23'
        ]);

        Category::create([
            'name' => 'Valorant',
            'slug' => 'valorant'
        ]);

        Tournament::factory(30)->create();

        // Tournament::create([
        //     'title' => 'Piala Presiden',
        //     'slug' => 'piala-presiden',
        //     'date' => '2022-12-10',
        //     'participants' => '32',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Tournament::create([
        // 'title' => 'Piala Presiden',
        //     'slug' => 'piala-presiden2',
        //     'date' => '2022-12-10',
        //     'participants' => '32',
        //     'category_id' => 2,
        //     'user_id' => 1
        // ]);

        // Tournament::create([
        // 'title' => 'Piala Kaleng',
        //     'slug' => 'piala-kaleng',
        //     'date' => '2022-12-15',
        //     'participants' => '16',
        //     'category_id' => 2,
        //     'user_id' => 2
        // ]);
    }
}
