<?php

use App\Models\User;
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

        /**
         * Add Users
         *
         */
        if (User::where('email', '=', 'admin@admin.com')->first() === null) {
            $newUser = User::create([
                'email' => 'admin@admin.com',
                'name' => "Admin",
                'password' => '',
            ]);

        }


    }
}
