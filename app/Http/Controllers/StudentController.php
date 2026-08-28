<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return redirect()->route('students.create');
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'      => 'required|unique:students,student_id|max:20',
            'first_name'      => 'required|string|max:100',
            'middle_name'     => 'nullable|string|max:100',
            'last_name'       => 'required|string|max:100',
            'email'           => 'required|email|unique:students,email',
            'mobile_number'   => 'required|numeric|digits_between:10,15',
            'date_of_birth'   => 'required|date|before:today',
            'gender'          => 'required|in:Male,Female,Non-binary,Prefer not to say',
            'program'         => 'required|string',
            'year_level'      => 'required|in:1st Year,2nd Year,3rd Year,4th Year',
            'address'         => 'required|string|max:500',
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('profile_picture')->store('students', 'public');
        $validated['profile_picture'] = $path;

        $student = Student::create($validated);

        return redirect()->route('students.show', $student->id)
            ->with('success', 'Student registered successfully!');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }
}