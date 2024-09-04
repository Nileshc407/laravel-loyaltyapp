<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Enrollment;
use Faker\Factory as Faker;
class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        for($i=0;$i<10;$i++)
        {
            $enrollment = new Enrollment;

            $enrollment->name = $faker->name;
            $enrollment->phone = $faker->phoneNumber;
        //  $enrollment->email = $faker->email;
            $enrollment->email = $faker->unique()->safeEmail;
            $enrollment->password = $faker->password;
            $enrollment->address = $faker->address;
            $enrollment->country = '101';
            $enrollment->state = '22';
            $enrollment->city = '2645';
            $enrollment->profession = 'Tech';
            $enrollment->gender = 'M';
            $enrollment->user_id = '1';
            $enrollment->remark = 'dummy data';

            $enrollment->save();
        }
    }
}
