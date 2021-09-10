<?php

use Illuminate\Database\Seeder;
use App\Http\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => '井上大樹',
                'email' => 'test@aaa.com',
                'password' => Hash::make('test123'),
                'image_path' => '',
                'gender' => '1',
                'age' => '1',
                'bio' => 'よろしくお願いします。'
            ],
            [
                'name' => '花子',
                'email' => '123@bbbb.com',
                'password' => Hash::make('test456'),
                'image_path' => '',
                'gender' => '1',
                'age' => '3',
                'bio' => 'こんにちは。'
            ]
        ]);
        factory(User::class, 50)->create();
    }
}



