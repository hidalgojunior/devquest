@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-4">Bem-vindo, {{ $user->name }} (Professor)</h2>
        <ul class="flex flex-wrap gap-4 mb-2">
            <li><a href="{{ route('students.import.form') }}" class="px-4 py-2 bg-blue-100 hover:bg-blue-200 rounded">Importar alunos</a></li>
            <li><a href="{{ route('students.register.form') }}" class="px-4 py-2 bg-blue-100 hover:bg-blue-200 rounded">Registrar aluno manualmente</a></li>
            <li><a href="{{ route('presences.index') }}" class="px-4 py-2 bg-blue-100 hover:bg-blue-200 rounded">Marcar presenças</a></li>
            <li><a href="{{ route('activities.index') }}" class="px-4 py-2 bg-blue-100 hover:bg-blue-200 rounded">Gerenciar atividades</a></li>
            <li><a href="{{ route('configurations.index') }}" class="px-4 py-2 bg-blue-100 hover:bg-blue-200 rounded">Configurar pontuações</a></li>
        </ul>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-xl font-semibold mb-2">Turmas</h3>
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-100"><tr><th class="px-2 py-1 text-left">Nome</th><th class="px-2 py-1 text-left">Quantidade de alunos</th></tr></thead>
                <tbody>
                    @foreach($groups as $g)
                        <tr class="border-t"><td class="px-2 py-1">{{ $g->name }}</td><td class="px-2 py-1">{{ $g->users_count }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-xl font-semibold mb-2">Ranking de Pontos</h3>
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-100"><tr><th class="px-2 py-1 text-left">Aluno</th><th class="px-2 py-1 text-left">Pontos</th><th class="px-2 py-1 text-left">Nível</th><th class="px-2 py-1 text-left">Badge</th></tr></thead>
                <tbody>
                    @foreach($ranking as $r)
                        <tr class="border-t">
                            <td class="px-2 py-1">{{ $r['user']->name }}</td>
                            <td class="px-2 py-1">{{ $r['points'] }}</td>
                            <td class="px-2 py-1">{{ $r['level'] }}</td>
                            <td class="px-2 py-1">{{ $r['badge'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection