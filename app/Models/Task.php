<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'employee_id', 'status', 'due_date'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}