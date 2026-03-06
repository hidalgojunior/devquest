<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\ClassGroup;
use App\Models\Presence;
use Carbon\Carbon;

class PresenceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function teacher_can_view_attendance_page()
    {
        $teacher = User::factory()->create(['role' => 'teacher']);
        $group = ClassGroup::factory()->create(['name' => 'A']);
        $response = $this->actingAs($teacher)->get(route('presences.index')); 
        $response->assertStatus(200);
        $response->assertSee('Registro de Presença');
    }

    /** @test */
    public function storing_presence_marks_students_correctly()
    {
        $teacher = User::factory()->create(['role' => 'teacher']);
        $group = ClassGroup::factory()->create();
        $studentA = User::factory()->create(['role' => 'student', 'class_group_id' => $group->id]);
        $studentB = User::factory()->create(['role' => 'student', 'class_group_id' => $group->id]);

        $date = Carbon::today()->toDateString();

        $response = $this->actingAs($teacher)->post(route('presences.store'), [
            'date' => $date,
            'group_id' => $group->id,
            'present' => [
                $studentA->id => 1,
                // studentB not included -> should be false
            ],
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('presences', [
            'user_id' => $studentA->id,
            'date' => $date,
            'present' => true,
        ]);
        $this->assertDatabaseHas('presences', [
            'user_id' => $studentB->id,
            'date' => $date,
            'present' => false,
        ]);
    }
}
