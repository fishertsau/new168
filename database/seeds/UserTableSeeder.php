<?php

use App\User;
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
        factory(User::class)->create([
            'email' => 'kevin@example.com',
            'name' => 'Kevin Doe',
            'password' => bcrypt('kevin'),
            'verified' => true
        ]);

        factory(User::class, 30)->create();
    }
}
