<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ClassGroup;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassGroup>
 */
class ClassGroupFactory extends Factory
{
    protected $model = ClassGroup::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->bothify('Turma ??'),
            'qr_open' => true,
        ];
    }
}
