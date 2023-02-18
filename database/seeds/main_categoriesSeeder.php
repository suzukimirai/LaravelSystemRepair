<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class main_categoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('main_categories')->insert([
            ['main_category' => '教科'],
        ]);

    }
}
