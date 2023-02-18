<?php

use Illuminate\Database\Seeder;
use App\Models\Categories\SubCategory;

class sub_categoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        SubCategory::create([
            'main_category_id' => '1',
            'sub_category' => '国語',
        ]);

        SubCategory::create([
            'main_category_id' => '1',
            'sub_category' => '英語',
        ]);

        SubCategory::create([
            'main_category_id' => '1',
            'sub_category' => '数学',
        ]);

    }
}
