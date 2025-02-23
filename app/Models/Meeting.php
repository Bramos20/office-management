<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'scheduled_at', 'organizer_id', 'participants'];

    protected $casts = [
        'participants' => 'array', // Convert JSON to array automatically
    ];

    public function organizer()
    {
        return $this->belongsTo(Employee::class, 'organizer_id');
    }
}
