<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Company::truncate();
        $faker = \Faker\Factory::create('zh_TW');
        foreach (range(1,30)as $id){
            \App\Company::create([
                'name' => $faker->company,
                'tax_id' => $faker->regexify('^[0-9]{8}$'),
                'create_date' => now(),
                'update_date' => now(),
            ]);
        }
    }
}
