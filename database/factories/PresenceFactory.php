<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Presence;
use App\Models\User;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Presence>
 */
class PresenceFactory extends Factory
{
    protected $model = Presence::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'date' => Carbon::today(),
            'present' => $this->faker->boolean,
        ];
    }
}
