<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trainer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'status', 'role_id'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function timeLogs()
    {
        return $this->hasMany(TimeLog::class);
    }

    public function getTotalWorkedMinutesAttribute(): int
    {
        return $this->timeLogs->sum(function ($log) {
            return (strtotime($log->end_time) - strtotime($log->start_time)) / 60;
        });
    }

    public function getTotalWorkedFormattedAttribute(): string
    {
        $totalMinutes = $this->total_worked_minutes;

        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;

        return "{$hours}h {$minutes}m";
    }
}
