<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Seeding demo Doctors to test
         */

        $faker = Faker::create();

        // Generate 100 doctors with random data
        $doctorsData = [];

        for ($i = 1; $i <= 100; $i++) {
            $doctorsData[] = [
                'name' => $faker->name,
                'phone' => '01' . $faker->numberBetween(3, 9) . $faker->randomNumber(8),
                'email' => $faker->unique()->safeEmail,
                'address' => $faker->address,
                'chamber_start' => $faker->time('H:i A'),
                'chamber_end' => $faker->time('H:i A'),
                'chamber_lat' => $faker->latitude,
                'chamber_long' => $faker->longitude,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Insert the data into the doctors table
        Doctor::insert($doctorsData);
    }
}
