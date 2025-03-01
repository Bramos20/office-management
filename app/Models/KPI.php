<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KPI extends Model
{
    use HasFactory;
    protected $table = 'kpis';

    protected $fillable = ['employee_id', 'kpi_name', 'target_value', 'actual_value', 'status'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
