@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- summary stats -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white p-4 rounded-lg shadow flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z"/>
            </svg>
            <div class="ml-3">
                <p class="text-sm text-gray-500">Turmas</p>
                <p class="text-xl font-bold">{{ $groups->count() }}</p>
            </div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.73 6.879 2.804M12 7a4 4 0 100 8 4 4 0 000-8z"/>
            </svg>
            <div class="ml-3">
                <p class="text-sm text-gray-500">Alunos</p>
                <p class="text-xl font-bold">{{ $totalStudents }}</p>
            </div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-4 0v2m0-2h4m2 0h2a2 2 0 002-2v-6a2 2 0 00-2-2h-2M7 13V5a2 2 0 012-2h6a2 2 0 012 2v8"/>
            </svg>
            <div class="ml-3">
                <p class="text-sm text-gray-500">Atividades</p>
                <p class="text-xl font-bold">{{ $totalActivities }}</p>
            </div>
        </div>
    </div>

    <!-- action cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <a href="{{ route('students.import.form') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
            <h3 class="font-semibold text-lg">Importar alunos</h3>
        </a>
        <a href="{{ route('students.register.form') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
            <h3 class="font-semibold text-lg">Registrar aluno</h3>
        </a>
        <a href="{{ route('presences.index') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
            <h3 class="font-semibold text-lg">Marcar presenças</h3>
        </a>
        <a href="{{ route('activities.index') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
            <h3 class="font-semibold text-lg">Gerenciar atividades</h3>
        </a>
        <a href="{{ route('configurations.index') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
            <h3 class="font-semibold text-lg">Configurar pontuações</h3>
        </a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-xl font-semibold mb-2">Turmas</h3>
        <div class="overflow-x-auto">
            <table class="w-full table-auto divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 text-left">Nome</th>
                        <th class="py-2 px-4 text-left">Quantidade de alunos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($groups as $g)
                    <tr class="odd:bg-white even:bg-gray-50">
                        <td class="py-2 px-4">{{ $g->name }}</td>
                        <td class="py-2 px-4">{{ $g->users_count }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-xl font-semibold mb-2">Ranking de Pontos</h3>
        <div class="overflow-x-auto">
            <table class="w-full table-auto divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 text-left">Aluno</th>
                        <th class="py-2 px-4 text-left">Pontos</th>
                        <th class="py-2 px-4 text-left">Nível</th>
                        <th class="py-2 px-4 text-left">Badge</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ranking as $r)
                    @php
                        $bg = '';
                        if($loop->first) $bg = 'bg-yellow-100';
                        elseif($loop->index == 1) $bg = 'bg-gray-100';
                        elseif($loop->index == 2) $bg = 'bg-yellow-200';
                    @endphp
                    <tr class="odd:bg-white even:bg-gray-50 {{ $bg }}">
                        <td class="py-2 px-4 flex items-center">
                            @if($loop->index < 3)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5 4v1a3 3 0 01-3 3H5a3 3 0 01-3-3v-1m6-4V4h6v4"/>
                                </svg>
                            @endif
                            {{ $r['user']->name }}
                        </td>
                        <td class="py-2 px-4">{{ number_format($r['points'],0,',','.') }}</td>
                        <td class="py-2 px-4">{{ $r['level'] }}</td>
                        <td class="py-2 px-4">{{ $r['badge'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

