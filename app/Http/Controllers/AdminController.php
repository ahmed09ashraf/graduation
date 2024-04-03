<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Department;
use App\Models\Uniform;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $colleges = College::all();
        $departments = Department::all();
        $uniforms = Uniform::all();

        return view('admin.admin', compact('colleges', 'departments', 'uniforms'));
    }



    // Store a new college
    public function storeColleges(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        College::create($request->only('name'));

        $activeSection = $request->input('activeSection', 'colleges');
        return redirect()->route('admin') . '#' . $activeSection;

    }

    // Store a new department
    public function storeDepartments(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'college_id' => 'required|exists:colleges,id'
        ]);

        Department::create($request->only(['name', 'college_id']));

        $activeSection = $request->input('activeSection', 'departments');
        return redirect()->route('admin') . '#' . $activeSection;
    }

    // Store a new uniform
    public function storeUniforms(Request $request)
    {
        $request->validate(['item' => 'required|string|max:255']);

        Uniform::create($request->only('item'));

        $activeSection = $request->input('activeSection', 'uniforms');
        return redirect()->route('admin') . '#' . $activeSection;
    }
    // Delete a college
    public function deleteCollege($id)
    {
        College::findOrFail($id)->delete();
        return back()->with('success', 'College deleted successfully');
    }

    // Delete a department
    public function deleteDepartment($id)
    {
        Department::findOrFail($id)->delete();
        return back()->with('success', 'Department deleted successfully');
    }

    // Delete a uniform
    public function deleteUniform($id)
    {
        Uniform::findOrFail($id)->delete();
        return back()->with('success', 'Uniform deleted successfully');
    }


}
