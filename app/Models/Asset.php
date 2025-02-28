<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category', 'serial_number', 'status', 'assigned_to'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'assigned_to');
    }
}
