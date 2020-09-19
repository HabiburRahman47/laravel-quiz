<?php

use App\Models\V1\User\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user= new User();
        // $user->name='Araf Islam';
        // $user->email='rezwanul@gmail.com';
        // $user->password='123456';
        // $user->save();

        $usersData = [
            [
                'name' => 'Mostafizur Rahman',
                'email' => 'mostafiza@gmail.com',
                'password' => '12345'
            ],
            [
                'name' => 'Dipayan Biswas',
                'email' => 'dipayan@gmail.com',
                'password' => '23456'
            ],
            [
                'name' => 'Rezwanul Islam',
                'email' => 'rezwanul@gmail.com',
                'password' => '34567'
            ],
            [
                'name' => 'Habibur Rahman',
                'email' => 'habibur@gmail.com',
                'password' => '45678'
            ],
            [
                'name' => 'Souvik Kar',
                'email' => 'souvik@gmail.com',
                'password' => 'abcde'
            ],
            [
                'name' => 'Koushik Roy',
                'email' => 'koushik@gmail.com',
                'password' => '56789'
            ],
            [
                'name' => 'Minhazul Arnab',
                'email' => 'minhazul@gmail.com',
                'password' => 'bcdef'
            ],
            [
                'name' => 'Toufikur Rahman',
                'email' => 'toufikur@gmail.com',
                'password' => 'abc12'
            ],
            [
                'name' => 'Reazul Rahi',
                'email' => 'reazul@gmail.com',
                'password' => '23456'
            ],
            [
                'name' => 'Kamrun Nisha',
                'email' => 'kamrunnisha@gmail.com',
                'password' => '*12ab#'
            ],
        ];

        foreach($usersData as $users)
        factory(User::class)->create([
            'name' => $users['name'],
            'email' => $users['email'],
            'password' => $users['password']

        ]);
    }
}
