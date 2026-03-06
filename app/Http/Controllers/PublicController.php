<?php

namespace App\Http\Controllers;

use App\Models\ClassGroup;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\User;
use App\Services\ScoreCalculator;

class PublicController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'student')->with('classGroup')->get();

        $overall = $students->map(function ($student) {
            return [
                'student' => $student,
                'points' => ScoreCalculator::calculateForUser($student),
            ];
        })->sortByDesc('points')->take(20)->values();

        $topBySubject = Subject::orderBy('name')->get()->map(function ($subject) {
            $groupsA = Schedule::where('subject_id', $subject->id)
                ->whereHas('classGroup', function ($q) {
                    $q->where('name', 'like', '%A%');
                })
                ->pluck('class_group_id')
                ->unique();

            $groupsB = Schedule::where('subject_id', $subject->id)
                ->whereHas('classGroup', function ($q) {
                    $q->where('name', 'like', '%B%');
                })
                ->pluck('class_group_id')
                ->unique();

            $winnerA = null;
            $winnerB = null;

            if ($groupsA->isNotEmpty()) {
                $winnerA = User::where('role', 'student')
                    ->whereIn('class_group_id', $groupsA)
                    ->get()
                    ->map(fn ($s) => ['student' => $s, 'points' => ScoreCalculator::calculateForUser($s)])
                    ->sortByDesc('points')
                    ->first();
            }

            if ($groupsB->isNotEmpty()) {
                $winnerB = User::where('role', 'student')
                    ->whereIn('class_group_id', $groupsB)
                    ->get()
                    ->map(fn ($s) => ['student' => $s, 'points' => ScoreCalculator::calculateForUser($s)])
                    ->sortByDesc('points')
                    ->first();
            }

            if (!$winnerA && !$winnerB) {
                return null;
            }

            return [
                'subject' => $subject,
                'winnerA' => $winnerA,
                'winnerB' => $winnerB,
            ];
        })->filter()->values();

        return view('public.index', compact('overall', 'topBySubject'));
    }
}
