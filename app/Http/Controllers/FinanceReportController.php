<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finance;
use App\Models\Department;

class FinanceReportController extends Controller
{
    /**
     * Show Profit & Loss Statement.
     */
    public function profitLoss()
    {
        $departments = Department::all();
        $report = [];

        foreach ($departments as $department) {
            $income = Finance::where('department_id', $department->id)
                ->where('transaction_type', 'income')
                ->sum('amount');

            $expenses = Finance::where('department_id', $department->id)
                ->where('transaction_type', 'expense')
                ->sum('amount');

            $profit = $income - $expenses;

            $report[] = [
                'department' => $department->name,
                'income' => $income,
                'expenses' => $expenses,
                'profit' => $profit
            ];
        }

        return view('finances.reports.profit_loss', compact('report'));
    }

    /**
     * Show General Ledger.
     */
    public function ledger()
    {
        $transactions = Finance::latest()->paginate(15);

        return view('finances.reports.ledger', compact('transactions'));
    }
}
