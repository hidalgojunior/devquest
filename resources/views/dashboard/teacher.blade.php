@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Bem-vindo, {{ $user->name }} (Professor)</h2>
    <ul class="list-disc pl-5">
        <li><a href="{{ route('students.import.form') }}" class="text-blue-600">Importar alunos</a></li>
        <li><a href="{{ route('students.register.form') }}" class="text-blue-600">Registrar aluno manualmente</a></li>
        <li><a href="{{ route('presences.index') }}" class="text-blue-600">Marcar presenças</a></li>
        <li><a href="{{ route('activities.index') }}" class="text-blue-600">Gerenciar atividades</a></li>
        <li><a href="{{ url('/configurations') }}" class="text-blue-600">Configurar pontuações</a> <!-- TODO: implement page --> </li>
    </ul>
    <h3 class="mt-6 text-xl font-semibold">Turmas</h3>
    <table class="w-full table-auto">
        <thead><tr><th>Nome</th><th>Quantidade de alunos</th></tr></thead>
        <tbody>
            @foreach($groups as $g)
                <tr><td>{{ $g->name }}</td><td>{{ $g->users_count }}</td></tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="mt-6 text-xl font-semibold">Ranking de Pontos</h3>
    <table class="w-full table-auto">
        <thead><tr><th>Aluno</th><th>Pontos</th><th>Nível</th><th>Badge</th></tr></thead>
        <tbody>
            @foreach($ranking as $r)
                <tr>
                    <td>{{ $r['user']->name }}</td>
                    <td>{{ $r['points'] }}</td>
                    <td>{{ $r['level'] }}</td>
                    <td>{{ $r['badge'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection