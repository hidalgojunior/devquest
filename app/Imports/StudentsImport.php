<?php

namespace App\Imports;

use App\Models\User;
use App\Models\ClassGroup;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // determine class group
        $groupName = 'Turma ' . strtoupper($row['turma']);
        $class = ClassGroup::firstOrCreate(['name' => $groupName], ['course' => 'Desenvolvimento de Sistemas', 'component'=>'Programação Web II']);

        return new User([
            'rm' => $row['rm'],
            'name' => $row['nome'],
            'email' => $row['email'] ?? null,
            'phone' => $row['telefone'] ?? null,
            'cpf' => $row['cpf'] ?? null,
            'birthdate' => isset($row['data_nascimento']) ? \Carbon\Carbon::parse($row['data_nascimento'])->format('Y-m-d') : null,
            'role' => 'student',
            'class_group_id' => $class->id,
            'password' => bcrypt('\$ecret'), // will not be used since login via RM+generated
        ]);
    }
}
