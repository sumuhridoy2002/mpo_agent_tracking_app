<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Seeding the demo Super admin to test the applicatiion
         */
        User::create([
            'name'           => 'Super Admin',
            'phone'          => '01900000000',
            'phone_verified' => true,
            'password'       => bcrypt('12345678'),
            'role'           => 'Super Admin',
            'designation'    => 'MPO Administrator',
            'account_status' => 'Active',
            'certification'  => 'MBA',
            'nid'            => '123456789',
            'passport'       => '0123456789',
            'address'        => 'House-02 Road-14, Dhaka 1230',
            'created_at'     => now(),
            'updated_at'     => now()
        ]);
    }
}