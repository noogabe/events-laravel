<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->create([
            'name' => 'Gabi', 
            'email' => 'gabriele@email.com.br', 
            'password' => bcrypt('miau1234')
        ]);

        // factory(User::class, 30)->create();
    }
}
