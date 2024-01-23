<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Seeding two demo Admin to test [login]
         */
        User::insert([
            [
                'name'           => 'Md. Hridoy',
                'phone'          => '01900000001',
                'phone_verified' => true,
                'password'       => bcrypt('12345678'),
                'role'           => 'Admin',
                'designation'    => 'ERP Administrator',
                'account_status' => 'Active',
                'certification'  => 'CSE',
                'nid'            => '1214675644',
                'passport'       => '124423423656',
                'address'        => 'House-03 Road-31, Dhaka 1235',
                'created_at'     => now(),
                'updated_at'     => now()
            ],
            [
                'name'           => 'Abirul Islam Abir',
                'phone'          => '01900000002',
                'phone_verified' => true,
                'password'       => bcrypt('12345678'),
                'role'           => 'Admin',
                'designation'    => 'ERP Administrator',
                'account_status' => 'Active',
                'certification'  => 'MBA',
                'nid'            => '5654654654',
                'passport'       => '235345345775',
                'address'        => 'House-02 Road-14, Dhaka 1230',
                'created_at'     => now(),
                'updated_at'     => now()
            ]
        ]);
    }
}
