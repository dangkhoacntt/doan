<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
 use Illuminate\Support\Str;
 use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        $data=[
            [
                'cate_name'=>'iphone',
             'cate_slug'=> Str::slug('iphone')
            ],
            [
                'cate_name'=>'Samsung',
             'cate_slug'=> Str::slug('Samsung')
            ]   
        ];
        DB::table('vp_categories')->insert($data);
    }
}
