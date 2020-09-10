<?php

use Illuminate\Database\Seeder;

class VotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Vote::truncate();
        \App\VoteOption::truncate();
//        $faker = \Faker\Factory::create('zh_TW');
//        foreach (range(1,30)as $id){
//            \App\Vote::create([
//                'title' => $faker->realText(10),
//                'company_id' => rand(1,30),
//                'user_id' => 1,
//                'type' => rand(0,1),
//                'option_type' => rand(0,1),
//                'create_date' => now(),
//                'deadline'  => now()->addDays(7),
//                'update_date' => now(),
//            ]);
//        }
    }
}
