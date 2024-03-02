<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'member one';
        $user->email = 'memberone@gmail.com';
        $user->phone = '01010101010';
        $user->status = 1;
        $user->address = 'Earth Country , Sky Street';
        $user->password = bcrypt('123456');
        $user->last_login_date = '-----';
        $user->last_logout_date = '-----';
        $user->save();
    }
}
