<?php

namespace Database\Seeders;

use App\Models\Target;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Seeding targets to test
         */
        $targets = [];
        
        $faker = Faker::create();

        for ($i = 1; $i <= 5; $i++) {
            $targets[] = [
                'user_id' => $faker->numberBetween(2, 3),
                'title' => 'New Year Target ' . $i,
                'description' => $faker->sentence,
                'amount' => $faker->numberBetween(100000, 500000),
                'agents' => json_encode([
                    [
                        'agent_id' => $faker->numberBetween(4, 11),
                        'schedules' => [
                            ['uid' => 'xasd' . $faker->numberBetween(1, 100), 'doctor_id' => $faker->numberBetween(1, 10)],
                            ['uid' => 'xasd' . $faker->numberBetween(1, 100), 'doctor_id' => $faker->numberBetween(1, 10)]
                        ]
                    ],
                    [
                        'agent_id' => $faker->numberBetween(4, 10),
                        'schedules' => [
                            ['uid' => 'xasd' . $faker->numberBetween(1, 100), 'doctor_id' => $faker->numberBetween(1, 10)],
                            ['uid' => 'xasd' . $faker->numberBetween(1, 100), 'doctor_id' => $faker->numberBetween(1, 10)]
                        ]
                    ]
                ]),
                'tests' => json_encode([
                    ['test_id' => $faker->numberBetween(1, 100), 'target_amount' => $faker->numberBetween(10000, 50000), 'amount_collected' => 0],
                    ['test_id' => $faker->numberBetween(1, 100), 'target_amount' => $faker->numberBetween(10000, 50000), 'amount_collected' => 0]
                ])
            ];
        }

        Target::insert($targets);
    }
}