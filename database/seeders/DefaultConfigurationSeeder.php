<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaults = [
            'point_presence' => 1,
            'point_on_time' => 2,
            'point_missed' => -2,
            'point_late' => -3,
            'point_late_15' => -2,
            'point_late_30' => -5,
            'point_occurrence' => -1,
        ];
        foreach($defaults as $key => $value) {
            \App\Models\Configuration::updateOrCreate(['key'=>$key], ['value'=>$value]);
        }
    }
}
