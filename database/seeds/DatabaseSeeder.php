<?php

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
        $this->call(UsersTableSeeder::class);
        $this->call(main_categoriesSeeder::class);
        $this->call(sub_categoriesSeeder::class);
        $this->call(SubjectsTableSeeder::class);


    }
}