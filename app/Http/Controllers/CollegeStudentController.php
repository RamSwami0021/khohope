<?php

namespace App\Http\Controllers;

use App\Models\CollegeStudent;
use Illuminate\Http\Request;

class CollegeStudentController extends Controller
{
    // API to create a new college student
    public function create(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:college_students',
            'username' => 'required',
            'phone' => 'required|string',
        ]);

        $student = CollegeStudent::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'phone_number' => $request->phone,
        ]);

        return response()->json($student, 201);
    }

    public function getByEmail($email)
    {
        $student = CollegeStudent::where('email', $email)->firstOrFail();
        return response()->json($student);
    }

    public function getByPhoneNumber($phoneNumber)
    {
        $student = CollegeStudent::where('phone_number', $phoneNumber)->firstOrFail();
        return response()->json($student);
    }

    public function getAll()
    {
        $students = CollegeStudent::all();
        return response()->json($students);
    }
}
