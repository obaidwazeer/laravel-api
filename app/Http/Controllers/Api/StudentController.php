<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Display all the students record
    public function index(){
        $students = Student::all();
        if($students->count() > 0){
            return response()->json([
                "status" => 'Success',
                "students" => $students,
                'message' => 'Data returned successfully'

            ],200);
        } else {
            return response()->json([
                "status"=> "fail",
                'students' => [],
                "message"=> 'No data found',
            ],404);
        }

    }
    // Store the student records
    public function store(Request $request){
        $validation = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:students',
            'course' => 'required|string|max:50',
            'phone' => 'required|digits:11'
        ]);
        if(!$validation){
            return response()->json([
                'status' => 'false',
                'message' => 'validation required'
            ],422);
        }else{
            $student = Student::create([
                'name' => $request->name,
                'email' => $request->email,
                'course' => $request->course,
                'phone' => $request->phone
            ]);
            if($student->count() > 0){
                return response()->json([
                    'status' => 'success',
                    'data' => $student,
                    'message' => 'Student has been created successfully'
                ],200);
            } else {
                return response()->json([
                    'status' => 'false',
                    'data' => [],
                    'message' => 'Failed to create student'
                ],422);
            }
        }
    }
    // Display a single record
    public function getSingle($id){

            $student = Student::find($id);
            if(!$student){
                return response()->json([
                    'success' => 'false',
                    'message' => 'Record do not found'
                ], 200);
            } else {
                return response()->json([
                    'success' => 'true',
                    'student' => $student,
                    'message' => 'Data returned successfully'
                ],200);
            }
    }
    // Edit the record
    public function edit($id){
        $student = Student::find($id);
            if(!$student){
                return response()->json([
                    'success' => 'false',
                    'message' => 'Record do not found'
                ], 200);
            } else {
                return response()->json([
                    'success' => 'true',
                    'student' => $student,
                    'message' => 'Data returned successfully'
                ],200);
            }
    }
    // Update the record
    public function update(Request $request, $id){
        $validation = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:students',
            'course' => 'required|string|max:50',
            'phone' => 'required|digits:11'
        ]);
        if(!$validation){
            return response()->json([
                'status' => 'false',
                'message' => 'validation required'
            ],422);
        }else{
            $student = Student::find($id);
            if($student){
                $student->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'course' => $request->course,
                    'phone' => $request->phone
                ]);
                return response()->json([
                    'status' => 'success',
                    'data' => $student,
                    'message' => 'Student has been created successfully'
                ],200);
            } else {
                return response()->json([
                    'status' => 'false',
                    'data' => [],
                    'message' => 'Failed to create student'
                ],422);
            }
        }
    }
    // Delete the record
    public function delete($id){
        $student = Student::find($id);
        if($student){
            $student->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Record has been deleted successfully'
            ],200);
        } else {
            return response()->json([
                'status' => 'false',
                'message' => 'No record found'
            ],422);
        }
    }
}
