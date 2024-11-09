<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sets;
use App\Models\Enrollments;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent;
use Validator;

class SetsController extends Controller
{
    public function addSets(Request $request, $course_id){
        $validator = Validator::make(request()->all(), [
            'name' => 'required'
        ],
        [
            'name.required' => 'The name field is required.'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid field(s) in request',
                'errors' => $validator->errors()->toJson()
            ], 400);
        }

        $setsCount = Sets::query()->where('course_id', $course_id)->count();

        
        $sets = new Sets();
        $sets->name = $request->name;
        $sets->course_id = $request->course_id;
        $sets->order = $setsCount;
        $sets->save();

        return response()->json([
            'status' => 'success',
            'message' => "Set successfully added",
            "data" => [
                'name' => $request->name,
                'order' => $setsCount,
                'id' => $sets->id,
            ]
        ]);
    }
}
