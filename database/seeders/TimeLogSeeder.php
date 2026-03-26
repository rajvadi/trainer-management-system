<?php

namespace Database\Seeders;

use App\Models\TimeLog;
use App\Models\Trainer;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TimeLogSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $trainers = Trainer::pluck('id')->toArray();

        // Create only 10–20 total logs
        $totalLogs = rand(10, 20);

        for ($i = 0; $i < $totalLogs; $i++) {

            $trainerId = $faker->randomElement($trainers);

            $date = $faker->dateTimeBetween('-15 days', 'now')->format('Y-m-d');

            // Start between 8 AM - 4 PM
            $startHour = rand(8, 16);
            $startMinute = $faker->randomElement([0, 15, 30, 45]);

            $startTime = sprintf('%02d:%02d', $startHour, $startMinute);

            // Duration 1–3 hours
            $duration = rand(1, 3);
            $endHour = $startHour + $duration;

            if ($endHour > 23) {
                $endHour = 23;
            }

            $endTime = sprintf('%02d:%02d', $endHour, $startMinute);

            TimeLog::create([
                'trainer_id' => $trainerId,
                'date' => $date,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'notes' => $faker->optional()->sentence(),
            ]);
        }
    }
}