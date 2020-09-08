<?php

use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Module::truncate();
        \App\CompanyPermission::truncate();

        $modules = ['管理員','公告','規定','投票','模組'];
        $modules_details = ['查看','新增','修正','刪除'];
        $faker = \Faker\Factory::create('zh_TW');

        $i = 0;

        foreach($modules as $module){
            foreach($modules_details as $modules_detail){
                $new_module = \App\Module::create([
                    'name' => $module . $modules_detail,
                    'create_date' => now(),
                    'update_date' => now(),
                ]);

                $companies = \App\Company::all();
                foreach($companies as $company){
                    \App\CompanyPermission::create([
                        'module_id' => $new_module->id,
                        'company_id' => $company->id,
//                        if permission == 2 mean only root can access
//                        if permission == 1 mean only root and level 1 user can access
//                        if permission == 0 mean everyone can access
                        'permission' => rand(0,2),
                        'create_date' => now(),
                        'update_date' => now(),
                    ]);
                }

            }

        }



    }
}
