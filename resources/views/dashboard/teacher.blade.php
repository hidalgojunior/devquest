@extends('layouts.app')

@section('content')
<div class="space-y-6">
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
                    <tr class="odd:bg-white even:bg-gray-50">
                        <td class="py-2 px-4">{{ $r['user']->name }}</td>
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

