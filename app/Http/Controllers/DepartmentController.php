<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        return response()->json(Department::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:departments']);

        $department = Department::create($request->all());
        return response()->json($department, 201);
    }

    public function show(Department $department)
    {
        return response()->json($department, 200);
    }

    public function update(Request $request, Department $department)
    {
        $request->validate(['name' => 'required|unique:departments,name,' . $department->id]);

        $department->update($request->all());
        return response()->json($department, 200);
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return response()->json(null, 204);
    }
}