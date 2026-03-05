<?php

namespace App\Services;

use App\Models\Configuration;
use App\Models\Presence;
use App\Models\Submission;
use App\Models\Occurrence;
use Carbon\Carbon;

class ScoreCalculator
{
    public static function config($key, $default = null)
    {
        $item = Configuration::where('key', $key)->first();
        return $item ? $item->value : $default;
    }

    public static function calculateForUser($user)
    {
        $points = 0;
        // presence
        $presencePoint = (int) self::config('point_presence', 1);
        $points += $user->presences()->where('present', true)->count() * $presencePoint;

        // submissions
        $onTime = (int) self::config('point_on_time', 2);
        $missed = (int) self::config('point_missed', -2);
        $late = (int) self::config('point_late', -3);
        foreach($user->submissions as $sub) {
            if (!$sub->submitted_at) {
                $points += $missed;
            } else {
                $due = $sub->activity->due_date;
                if ($sub->submitted_at->lte(Carbon::parse($due))) {
                    $points += $onTime;
                } else {
                    $points += $late;
                }
            }
        }

        // occurrences
        $occurPenalty = (int) self::config('point_occurrence', -1);
        foreach($user->occurrences as $occ) {
            $points += $occ['points'] ?? $occurPenalty;
        }

        return $points;
    }
}
