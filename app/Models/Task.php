<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $casts = [
        'created_at' => 'datetime:d.m.Y',
    ];
    protected $fillable = ['name'];
    
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }
}
