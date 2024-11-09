<?php

namespace Database\Seeders;

use App\Models\Sets; 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Sets = [
            [
                'name' => 'HTML Basics',
                'course_id' => '1',
                'order' => '0',
            ],
            [
                'name' => 'CSS Fundamentals',
                'course_id' => '1',
                'order' => '1',
            ],
            [
                'name' => 'HTML Basics',
                'course_id' => '2',
                'order' => '0',
            ],
            [
                'name' => 'CSS Basics',
                'course_id' => '2',
                'order' => '1',
            ],
            [
                'name' => 'JavaScript Basics',
                'course_id' => '3',
                'order' => '0',
            ],
            [
                'name' => 'Modern JavaScript Essentials',
                'course_id' => '3',
                'order' => '1',
            ],
            [
                'name' => 'JavaScript in Practice',
                'course_id' => '4',
                'order' => '0',
            ],
            [
                'name' => 'Responsive Design Techniques',
                'course_id' => '4',
                'order' => '1',
            ],
            [
                'name' => 'JavaScript in Practice',
                'course_id' => '5',
                'order' => '0',
            ],
            [
                'name' => 'Responsive Design Workshop',
                'course_id' => '5',
                'order' => '1',
            ],
        ];


        foreach($Sets as $key => $val ){
            Sets::create($val);
        }
    }
}
