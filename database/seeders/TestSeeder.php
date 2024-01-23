<?php

namespace Database\Seeders;

use App\Models\Test;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Seeding demo Test to test
         */
        $faker = Faker::create();

        // List of medical test names
        $medicalTestNames = [
            'X-ray',
            'Ultra sonogram',
            'Blood test',
            'MRI scan',
            'CT scan',
            'ECG',
            'Endoscopy',
            'Colonoscopy',
            'Mammogram',
            'Biopsy',
            'PET scan',
            'Dexa scan',
            'Echocardiogram',
            'Pap smear',
            'Prostate-specific antigen (PSA) test',
            'Thyroid function tests',
            'Hemoglobin A1c test',
            'Lipid panel',
            'Liver function tests',
            'Complete blood count (CBC)',
            'Urinalysis',
            'Stool culture',
            'Bone density test',
            'Electroencephalogram (EEG)',
            'Holter monitor',
            'Pulmonary function tests',
            'Skin biopsy',
            'Allergy testing',
            'HIV test',
            'Genetic testing',
            'C-reactive protein (CRP) test',
            'Thyroid ultrasound',
            'Colonography',
            'Blood culture',
            'Serum iron test',
            'Throat culture',
            'Arthroscopy',
            'Nerve conduction studies',
            'Sputum culture',
            'Cardiac catheterization',
            'Nuclear stress test',
            'Lumbar puncture (spinal tap)',
            'Barium swallow',
            'Tilt table test',
            'Patch test',
            'Glucose tolerance test',
            'Audiometry',
            'Visual field test'
        ];

        // Generate data for 100 tests
        $testsData = [];

        for ($i = 1; $i <= 100; $i++) {
            $testsData[] = [
                'name' => $faker->randomElement($medicalTestNames),
                'amount' => $faker->randomFloat(2, 100, 1000),
                'active_status' => $faker->randomElement(['Active', 'Inactive']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert the data into the tests table
        Test::insert($testsData);
    }
}