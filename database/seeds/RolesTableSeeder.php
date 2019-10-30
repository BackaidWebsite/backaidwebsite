<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\User;
use App\roles;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
              ['name' => 'User',],
              ['name' => 'Admin',]
        ]);

        $admin1 = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);
        $admin1->roles()->attach(roles::where('name', 'User')->first());
        $admin1->roles()->attach(roles::where('name', 'Admin')->first());

        $admin2 = User::create([
            'name' => 'Admin1',
            'email' => 'admin1@admin.com',
            'password' => Hash::make('password'),
        ]);
        $admin2->roles()->attach(roles::where('name', 'User')->first());
        $admin2->roles()->attach(roles::where('name', 'Admin')->first());

        $admin3 = User::create([
            'name' => 'Admin2',
            'email' => 'admin2@admin.com',
            'password' => Hash::make('password'),
        ]);
        $admin3->roles()->attach(roles::where('name', 'User')->first());
        $admin3->roles()->attach(roles::where('name', 'Admin')->first());
    }
}
