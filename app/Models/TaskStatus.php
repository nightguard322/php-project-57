<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Добавьте эту строку
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskStatus extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:d.m.Y',
    ];
    protected $fillable = ['name'];
    protected $hidden = ['updated_at'];

    /**
     * @tasks relations
     *
     * @return HasMany
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'status_id');
    }
}
