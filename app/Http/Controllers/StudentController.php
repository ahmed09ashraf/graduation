<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Department;
use App\Models\Student;
use App\Models\Uniform;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all(); // Get all reservations
        $colleges = College::all();
        $departments = Department::all();
        $uniforms = Uniform::all();
        return view('index', compact('students' , 'colleges' , 'departments' , 'uniforms')); // Pass reservations to the view
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'student_name' => 'required|string',
            'college_id' => 'required|exists:colleges,id',
            'department_id' => 'required|exists:departments,id',
            'clothes' => 'required|array',
            'family_members' => 'nullable|integer|min:0',
            'total_price' => 'required|numeric',
        ]);

        // Create a new student record
        $student = new Student();
        $student->student_name = $request->input('student_name');
        $student->college_id = $request->input('college_id');
        $student->department_id = $request->input('department_id');
        $student->clothes = $request->input('clothes');
        $student->family_members = $request->input('family_members', 0); // Set default value if not provided
        $student->total_price = $request->input('total_price');
        $student->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Student reservation added successfully.');
    }

    public function getDepartments($collegeId)
    {
        $departments = Department::where('college_id', $collegeId)->pluck('name', 'id');
        return response()->json($departments);
    }
}
