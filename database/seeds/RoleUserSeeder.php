<?php

use App\models\RoleUser;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoleUser::create([
            'name' => 'Admin'
        ]);
        RoleUser::create([
            'name' => 'Kasir'
        ]);
        RoleUser::create([
            'name' => 'Management'
        ]);
    }
}
