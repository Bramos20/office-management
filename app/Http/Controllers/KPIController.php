<?php

namespace App\Http\Controllers;

use App\Models\KPI;
use App\Models\Employee;
use Illuminate\Http\Request;

class KPIController extends Controller
{
    public function index()
    {
        $kpis = KPI::with('employee')->get();
    
        // Prepare KPI data for chart
        $chartData = $kpis->map(function ($kpi) {
            return [
                'employee' => $kpi->employee->name,
                'kpi_name' => $kpi->kpi_name,
                'target_value' => $kpi->target_value,
                'actual_value' => $kpi->actual_value ?? 0
            ];
        });
    
        return view('kpis.index', compact('kpis', 'chartData'));
    }    

    public function create()
    {
        $employees = Employee::all();
        return view('kpis.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'kpi_name' => 'required|string|max:255',
            'target_value' => 'required|integer|min:1',
            'actual_value' => 'nullable|integer|min:0',
            'status' => 'required|in:on track,needs improvement,off track'
        ]);

        KPI::create($request->all());

        return redirect()->route('kpis.index')->with('success', 'KPI added successfully.');
    }
}
