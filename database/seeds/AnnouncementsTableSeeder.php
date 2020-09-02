<?php

use Illuminate\Database\Seeder;

class AnnouncementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Announcement::truncate();
        $faker = \Faker\Factory::create('zh_TW');
        foreach (range(1,50)as $id){
            \App\Announcement::create([
                'title' => $faker->realText(20),
                'content' => $faker->realText(200),
                'company_id' => rand(1,30),
                'user_id' => 1,
                'type' => rand(1,3),
                'create_date' => now(),
                'update_date' => now(),
            ]);

        }
    }
}
