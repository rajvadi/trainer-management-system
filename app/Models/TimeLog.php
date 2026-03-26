<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeLog extends Model
{
    protected $fillable = ['trainer_id', 'date', 'start_time', 'end_time', 'notes'];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function getWorkedHoursAttribute(): float
    {
        $start = strtotime($this->start_time);
        $end = strtotime($this->end_time);

        return round(($end - $start) / 3600, 2);
    }
}
