<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'over_name' => '鈴木',
            'under_name' => '未来',
            'over_name_kana' => 'スズキ',
            'under_name_kana' => 'ミライ',
            'mail_address' => ' smirai0717@gmail.com',
            'sex' => '1',
            'birth_day' => '1998-7-17',
            'role' => '4',
            'password' => 'Miraidesu0717',
        ]);

    }
}