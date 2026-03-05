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
        $late15 = (int) self::config('point_late_15', -2); // between due+1 and due+15?
        $late30 = (int) self::config('point_late_30', -5); // beyond due+15 up to 30
        foreach($user->submissions as $sub) {
            if (!$sub->submitted_at) {
                $points += $missed;
            } else {
                $due = Carbon::parse($sub->activity->due_date);
                if ($sub->submitted_at->lte($due)) {
                    $points += $onTime;
                } else {
                    $days = $due->diffInDays($sub->submitted_at);
                    if ($days <= 15) {
                        $points += $late15;
                    } elseif ($days <= 30) {
                        $points += $late30;
                    } else {
                        $points += $late30; // max penalty, closed maybe more
                    }
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
