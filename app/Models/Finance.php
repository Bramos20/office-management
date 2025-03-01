<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_type', 'amount', 'currency', 'category', 'description', 'approved_by', 'department_id'
    ];

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
