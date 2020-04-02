<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'id' => \Webpatser\Uuid\Uuid::generate(4),
                    'name' => 'Super Admin',
                    'email' => 'admin@gmail.com',
                    'password' => '$2y$10$3B4Xw.mY9DtpkTOsczTjyeWJM42Tr8N7gVIgEHfT9pxJjS5gn/MAC', // 123456
                    'verifyToken' => null,
                    'status' => 1,

                    'remember_token' => Str::random(60),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]
        );
    }
}
