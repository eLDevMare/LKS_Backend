<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Validator;

class CourseController extends Controller
{
    public function addCourse(Request $request){
        $validation = Validator::make(request()->all(),[
            'name' => 'required',
            'description' => 'nullable',
            'slug' => 'unique:course'
        ],
        [
            'name.required' => 'The name field is required',
            'slug.unique' => 'The slug has already been taken.',
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
            'data' => $course
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
}
