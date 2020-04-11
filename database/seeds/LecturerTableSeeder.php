<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Modules\Backend\Employee\Models\Employee;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Employee::truncate();

        foreach (range(1, 1000) as $i) {
            Employee::create([
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
