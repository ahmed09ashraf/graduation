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
}
