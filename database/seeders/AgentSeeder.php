<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Seeding demo Agents to test [login]
         */
        User::insert([
            [
                'name'           => 'Md. Hridoy',
                'phone'          => '01736187462',
                'phone_verified' => true,
                'designation'    => 'Laravel Developer',
                'certification'  => 'CSE',
                'nid'            => '12312446532',
                'passport'       => '3634634623523',
                'address'        => 'House-01 Road-11, Dhaka 1231',
                'password'       => bcrypt('12345678'),
                'account_status' => 'Active',
                'created_at'     => now(),
                'updated_at'     => now()
            ],
            [
                'name'           => 'Abirul Islam Abir',
                'phone'          => '01722734871',
                'phone_verified' => true,
                'designation'    => 'Flutter Developer',
                'certification'  => 'BSS',
                'nid'            => '3463463434',
                'passport'       => '34634636346346',
                'address'        => 'House-02 Road-12, Dhaka 1232',
                'password'       => bcrypt('12345678'),
                'account_status' => 'Active',
                'created_at'     => now(),
                'updated_at'     => now()
            ],
            [
                'name'           => 'Tahmid Islam Turzo',
                'phone'          => '01768031053',
                'phone_verified' => true,
                'designation'    => 'UI/UX Designer',
                'certification'  => 'BSS',
                'nid'            => '2343467424',
                'passport'       => '685682353434',
                'address'        => 'House-03 Road-13, Dhaka 1233',
                'password'       => bcrypt('12345678'),
                'account_status' => 'Active',
                'created_at'     => now(),
                'updated_at'     => now()
            ],
            [
                'name'           => 'Shahiar Islam',
                'phone'          => '01630456676',
                'phone_verified' => true,
                'designation'    => 'CEO of CodeCell',
                'certification'  => 'CSE',
                'nid'            => '34688457547',
                'passport'       => '02342396753443',
                'address'        => 'House-04 Road-14, Dhaka 1234',
                'password'       => bcrypt('12345678'),
                'account_status' => 'Active',
                'created_at'     => now(),
                'updated_at'     => now()
            ],
            [
                'name'           => 'Rakib Islam Rayhan',
                'phone'          => '01780425530',
                'phone_verified' => true,
                'designation'    => 'Head of Marketing',
                'certification'  => 'BBA',
                'nid'            => '456546754734',
                'passport'       => '89689235232354',
                'address'        => 'House-05 Road-15, Dhaka 1235',
                'password'       => bcrypt('12345678'),
                'account_status' => 'Active',
                'created_at'     => now(),
                'updated_at'     => now()
            ],
            [
                'name'           => 'Rubel Islam',
                'phone'          => '01301123920',
                'phone_verified' => true,
                'designation'    => 'Laravel Intern',
                'certification'  => 'CSE',
                'nid'            => '89891413323',
                'passport'       => '45670345334534',
                'address'        => 'House-06 Road-16, Dhaka 1236',
                'password'       => bcrypt('12345678'),
                'account_status' => 'Active',
                'created_at'     => now(),
                'updated_at'     => now()
            ],
            [
                'name'           => 'Omar Faruk',
                'phone'          => '01822637989',
                'phone_verified' => true,
                'designation'    => 'React Intern',
                'certification'  => 'CSE',
                'nid'            => '8978934892354',
                'passport'       => '8978934892354745',
                'address'        => 'House-07 Road-17, Dhaka 1237',
                'password'       => bcrypt('12345678'),
                'account_status' => 'Active',
                'created_at'     => now(),
                'updated_at'     => now()
            ],
            [
                'name'           => 'Amit Ansary',
                'phone'          => '01778101959',
                'phone_verified' => true,
                'designation'    => 'Director of Amin Diagnostic',
                'certification'  => 'CSE',
                'nid'            => '38892243235',
                'passport'       => '97867554346712',
                'address'        => 'House-08 Road-18, Dhaka 1238',
                'password'       => bcrypt('12345678'),
                'account_status' => 'Active',
                'created_at'     => now(),
                'updated_at'     => now()
            ]
        ]);
    }
}
