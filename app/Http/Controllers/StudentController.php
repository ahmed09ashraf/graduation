<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Department;
use App\Models\Student;
use App\Models\Uniform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $colleges = College::all();
        $departments = Department::all();
        $uniformsList = Uniform::all();

        return view('index', compact('students' , 'colleges' , 'departments' , 'uniformsList' )); // Pass reservations to the view
    }


    public function store(Request $request)
    {
        try {
            // Debugging statement to check request data
            Log::debug('Request data:', $request->all());

            // Validate the request
            $validatedData = $request->validate([
                'student_name' => 'required|string',
                'college_id' => 'required|exists:colleges,id',
                'department_id' => 'required|exists:departments,id',
                'uniform' => 'required|array',
                'student_price' => 'required|numeric',
                'family_members' => 'nullable|integer|min:0',
                'member_price' => 'required|numeric',
                'total_price' => 'required|numeric',
            ]);

            $student = Student::create($validatedData);
            $student->uniforms()->attach($request->input('uniform'));

            $student->save();

            // Redirect back with success message
            return redirect()->back()->with('success', 'Student reservation added successfully.');
        } catch (\Exception $e) {
            // Log error message
            Log::error('Error adding student reservation: ' . $e->getMessage());
            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred while adding the student reservation.');
        }
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $colleges = College::all();
        $departments = Department::all();
        $uniformsList = Uniform::all();

        Log::debug('Student data: ', (array)$student);


        return view('edit', compact('student', 'colleges', 'departments', 'uniformsList'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validatedData = $request->validate([
            'student_name' => 'required|string',
            'college_id' => 'required|exists:colleges,id',
            'department_id' => 'required|exists:departments,id',
            'uniform' => 'required|array',
            'student_price' => 'required|numeric',
            'family_members' => 'nullable|integer|min:0',
            'member_price' => 'required|numeric',
            'total_price' => 'required|numeric',
        ]);

        $student->update($validatedData);
        $student->uniforms()->sync($request->input('uniform'));

        return redirect()->route('reservations.index')->with('success', 'Student reservation updated successfully.');
    }

    public function delete($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->back()->with('success', 'Student reservation deleted successfully.');
    }

    public function getDepartments($collegeId)
    {
        $departments = Department::where('college_id', $collegeId)->pluck('name', 'id');
        return response()->json($departments);
    }
}
