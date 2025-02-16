<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Добавьте эту строку
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:d.m.Y',
    ];
    protected $fillable = ['name'];
    protected $hidden = ['updated_at'];
}
