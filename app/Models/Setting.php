<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'daily_reminder_time',
        'spending_limit',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 