@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-semibold mb-4">Horários</h1>
<a href="{{ route('schedules.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">Adicionar horário</a>
<table class="w-full table-auto divide-y divide-gray-200">
    <thead class="bg-gray-100"><tr><th>Dia</th><th>Hora</th><th>Turma</th><th>Componente</th></tr></thead>
    <tbody>
        @foreach($schedules as $s)
        <tr class="odd:bg-white even:bg-gray-50">
            <td class="px-4 py-2">{{ ucfirst($s->day_of_week) }}</td>
            <td class="px-4 py-2">{{ $s->start_time }}</td>
            <td class="px-4 py-2">{{ $s->classGroup->name }}</td>
            <td class="px-4 py-2">{{ $s->subject->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection