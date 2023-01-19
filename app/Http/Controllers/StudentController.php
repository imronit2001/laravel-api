<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function read()
    {
        $student = Student::all();
        return response()->json(['status' => 'success', 'status_code' => 200, 'data' => $student]);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'roll' => 'required',
            'name' => 'required',
            'stream' => 'required',
            'age' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'failure', 'status_code' => 400, 'message' => $validator->errors()]);
        }

        $check = Student::where('roll', $request->roll)->where('stream', $request->stream)->first();
        if ($check) {
            return response()->json(['status' => 'failure', 'status_code' => 400, 'message' => 'Student already exists']);
        }

        $student = new Student();
        $student->roll = $request->roll;
        $student->name = $request->name;
        $student->stream = $request->stream;
        $student->age = $request->age;
        $student->save();
        return response()->json(['status' => 'success', 'status_code' => 200, 'message' => 'Data Inserted']);
    }
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'failure', 'status_code' => 400, 'message' => $validator->errors()]);
        }

        Student::where('id', $request->id)->delete();
        return response()->json(['status' => 'success', 'status_code' => 200, 'message' => 'Data Deleted']);
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'failure', 'status_code' => 400, 'message' => $validator->errors()]);
        }

        $student = Student::where('id', $request->id)->first();
        if (!$student) {
            return response()->json(['status' => 'failure', 'status_code' => 400, 'message' => 'Student doesnot exists']);
        }

        if ($request->has('roll')) {
            $student->roll = $request->roll;
        }
        if ($request->has('name')) {
            $student->name = $request->name;
        }
        if ($request->has('stream')) {
            $student->stream = $request->stream;
        }
        if ($request->has('age')) {
            $student->age = $request->age;
        }
        $student->save();
        return response()->json(['status' => 'success', 'status_code' => 200, 'message' => 'Data Updated']);
    }
}
