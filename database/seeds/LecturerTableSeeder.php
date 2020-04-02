<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Modules\Backend\Lecturer\Models\Lecturer;

class LecturerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Lecturer::truncate();

        foreach (range(1, 1000) as $i) {
            Lecturer::create([
                // 'id' => \Webpatser\Uuid\Uuid::generate(4),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'gender' => $faker->randomElement(['M','F']),
                'age' => $faker->numberBetween($min = 25, $max = 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
