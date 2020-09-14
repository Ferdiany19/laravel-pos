<?php

use App\models\RoleUser;
use App\models\UserProfile;
use App\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_admin = User::create([
            'name' => 'admin',
            'email' => 'admin@pos.com',
            'password' => bcrypt('admin'),
            'role_user_id' => RoleUser::where('name','Admin')->first()->id,
        ]);
            
        UserProfile::create([
            'user_id' => $user_admin->id,
            'fullname' => 'admin',
            'gender' => 'm',
            'phone_number' => '999999999999',
            'address' => 'disini',
            'image' => 'sadasd'
        ]);
    }
}
