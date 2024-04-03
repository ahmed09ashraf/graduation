<?php

namespace Database\Seeders;

use App\Models\College;
use App\Models\Department;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $college_id = College::inRandomOrder()->first()->id; // Select a random college
            $department_id = Department::where('college_id', $college_id)->inRandomOrder()->first()->id; // Select a random department from the selected college

            // Generate random prices
            $student_price = $faker->randomFloat(2, 50, 300); // Assuming student prices range from 50 to 300
            $member_price = $faker->randomFloat(2, 20, 150); // Assuming member prices range from 20 to 150
            $family_members = $faker->numberBetween(0, 5);

            // Calculate total price
            $total_price = $student_price + ($member_price * $family_members);

            Student::create([
                'student_name' => $faker->name,
                'college_id' => $college_id,
                'department_id' => $department_id,
                'clothes' => json_encode([$faker->word, $faker->word]), // Example of clothes as an array of strings
                'family_members' => $family_members,
                'student_price' => $student_price,
                'member_price' => $member_price,
                'total_price' => $total_price,
            ]);
        }
    }
}
