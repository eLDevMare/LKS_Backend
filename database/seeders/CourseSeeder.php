<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $Course = [
            [
                'name' => 'Web Dev Fundamentals',
                'description' => 'Grasp the core technologies of HTML, CSS, and JavaScript.',
                'slug' => 'web-dev-fundamentals',
            ],
            [
                'name' => 'Full-Stack Mastery',
                'description' => 'Learn both front-end and back-end development for complete web applications.',
                'slug' => 'full-stack-mastery',
            ],
            [
                'name' => 'Modern JavaScript Essentials',
                'description' => 'Explore ES6+ features and modern JavaScript practices.',
                'slug' => 'modern-javascript-essentials',
            ],
            [
                'name' => 'Responsive Design Workshop',
                'description' => 'Create websites that adapt to any screen size or device.',
                'slug' => 'responsive-design-workshop',
            ],
            [
                'name' => 'Backend Development Bootcamp',
                'description' => 'Build robust server-side applications and APIs.',
                'slug' => 'backend-development-bootcamp',
            ],
        ];


        foreach($Course as $key => $val ){
            Course::create($val);
        }
    }
}
