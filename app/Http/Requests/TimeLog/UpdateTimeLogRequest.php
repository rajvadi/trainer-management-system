<?php

namespace App\Http\Requests\TimeLog;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\TimeLog;
use Closure;

class UpdateTimeLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'trainer_id' => ['required', 'exists:trainers,id'],
            'date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
                function (string $attribute, mixed $value, Closure $fail) {
                    $trainerId = $this->input('trainer_id');
                    $date = $this->input('date');
                    $startTime = $this->input('start_time');
                    $endTime = $this->input('end_time');
                    $timeLogId = $this->route('time_log')?->id ?? $this->route('timeLog')?->id;

                    if (!$trainerId || !$date || !$startTime || !$endTime) {
                        return;
                    }

                    $hasConflict = TimeLog::where('trainer_id', $trainerId)
                        ->whereDate('date', $date)
                        ->where('id', '!=', $timeLogId)
                        ->where(function ($query) use ($startTime, $endTime) {
                            $query
                                ->where(function ($q) use ($startTime, $endTime) {
                                    $q->where('start_time', '<', $endTime)
                                      ->where('end_time', '>', $startTime);
                                });
                        })
                        ->exists();

                    if ($hasConflict) {
                        $fail('This trainer already has a time log that overlaps with the selected time range.');
                    }
                },
            ],
            'notes' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'trainer_id.required' => 'Please select a trainer.',
            'trainer_id.exists' => 'Selected trainer is invalid.',
            'date.required' => 'Date is required.',
            'start_time.required' => 'Start time is required.',
            'end_time.required' => 'End time is required.',
            'end_time.after' => 'End time must be after start time.',
        ];
    }
}
