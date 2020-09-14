<?php

use App\models\RoleUser;
use App\models\UserProfile;
use App\User;
use Illuminate\Database\Seeder;

class UpdateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

	$admin = User::updateOrCreate(
		['email' => 'admin@pos.com']
		,[
		'name' => 'admin',
		'role_user_id' => RoleUser::where('name','Admin')->first()->id,
		'password' => bcrypt('admin')
		]);
    
	$management = User::updateOrCreate(
			['email' => 'management@pos.com']
			,[
			'name' => 'management',
			'role_user_id' => RoleUser::where('name','Management')->first()->id,
			'password' => bcrypt('management')
			]);
	        
	$kasir = User::updateOrCreate(
		['email' => 'kasir@pos.com']
		,[
		'name' => 'kasir',
		'role_user_id' => RoleUser::where('name','Kasir')->first()->id,
		'password' => bcrypt('kasir')
		]);

	UserProfile::updateOrCreate(
		['user_id' => $admin->id],
		[
		'fullname' => 'admin',
		'gender' => 'm',
		'phone_number' => '999999999999',
		'address' => 'disini',
		'image' => 'dsaasd'
		]);

	UserProfile::updateOrCreate(
		['user_id' => $management->id],                    
		[
		'fullname' => 'management',
		'gender' => 'm',
		'phone_number' => '999999999999',
		'address' => 'disini',
		'image' => 'dsaasd'
		]);
	
	UserProfile::updateOrCreate(
		['user_id' => $kasir->id],
		[
		'fullname' => 'kasir',    
		'gender' => 'm',
		'phone_number' => '999999999999',
		'address' => 'disini',
		'image' => 'dsaasd'
		]);

    }
}
