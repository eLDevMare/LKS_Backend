<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Course;
use App\Models\Enrollments;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent;
use Validator;

class CourseController extends Controller
{
    public function addCourse(Request $request){
        $validation = Validator::make(request()->all(),[
            'name' => 'required',
            'description' => 'nullable',
        ],
        [
            'name.required' => 'The name field is required',
        ]);

        if($validation->fails()){
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid field(s) in request',
                'errors' => $validation->errors()->toJson()
            ], 400);
        }

        $course = new Course();
        $course->name = $request->name;
        $course->description = $request->description;
        $course->slug = Str::slug($request->name);
        $course->save();

        return response()->json([
            "status" => 'success',
            'message' => 'Course successfully added',
            'data' => [
                'name' => $course->name,
                'description' => $course->description,
                'slug' => $course->slug,
                'updated_at' => $course->updated_at,
                'created_at' => $course->created_at,
                'id' => $course->id
            ]
        ], 201);
    }


    public function editCourse(){
        $validation = Validator::make(request()->all(),[
            'name' => 'required',
            'description' => 'nullable',
            'is_published' => 'nullable|boolean'
        ],
        [
            'name.required' => 'The name field is required',
            'slug.unique' => 'The slug has already been taken.',
        ]);
    }

    public function deleteCourse($slug){
        $course = Course::query()->where('slug', $slug)->first();
        if(!course){
            return response()->json([
                'status' => 'success',
                'messsage' => 'Course successfully deleted'
            ]);
        };

        $course->delete();

        return response()->json([
            'status' => 'not_found',
            'messsage' => 'Resource not found'
        ]);
    }

    public function getAllCourse(){
        $course = Course::query()->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Courses retrieved successfully',
            'data' => $course
        ], 200);
        
    }


    public function getDetailCourse($slug)
    {
        $course = Course::query()->where('slug', $slug)->first();
        $sets = $course->sets;

        $setsData = $sets->map(function ($set) {
            return [
                "id" => $set->id,
                "name" => $set->name,
                "order" => $set->order
            ];
        });

        return response()->json([
            "status" => "success",
            "message" => "Course details retrieved successfully",
            "data" => [
                "id" => $course->id,
                "name" => $course->name,
                "slug" => $course->slug,
                "description" => $course->description,
                "is_published" => $course->is_published,
                "created_at" => $course->created_at,
                "updated_at" => $course->updated_at, 
                "sets" =>$setsData
            ],
        ]);
    }

    public function courseRegister($slug, Request $request){
        $course = Course::query()->where('slug', $slug)->first();
        $registerAlready = Enrollments::query()
        ->where('course_id', $course->id)
        ->where('users_id', $request->user()->id)
        ->exists();

        if($registerAlready){
            return response()->json([
                "status" => "error",
                "message" => "The user is already registered for this course"
            ]);
        }

        Enrollments::query()->create([
            'course_id' => $course->id ,
            'users_id' => $request->user()->id,
        ]);

        return response()->json([
            "status" => "success",
            "message" => "User registered successful"
        ]);
    }

    public function getMyCourse(Request $request){
        $user = $request->user();
        $Mycourses = $user->courses;

        return response()->json([
            "status" => 'success',
            'message' => 'Your Courses',
            'data' => $Mycourses
        ]);
    }

    public function getOtherCourse(Request $request){
        $user = $request->user();
        $otherCourses = Course::whereDoesntHave('users', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->get();

        return response()->json([
            "status" => 'success',
            'message' => 'Other Courses',
            'data' => $otherCourses
        ]);
    }

}
