@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">{{ __('Bem-vindo') }}, {{ $user->name }} ({{ __('Professor') }})</h2>
    <ul class="list-disc pl-5">
        <li><a href="{{ route('students.import.form') }}" class="text-blue-600">{{ __('Importar alunos') }}</a></li>
        <li><a href="{{ route('students.register.form') }}" class="text-blue-600">{{ __('Registrar aluno manualmente') }}</a></li>
        <li><a href="{{ route('presences.index') }}" class="text-blue-600">{{ __('Marcar presenças') }}</a></li>
        <li><a href="{{ route('activities.index') }}" class="text-blue-600">{{ __('Gerenciar atividades') }}</a></li>
        <li><a href="{{ route('configurations.index') }}" class="text-blue-600">{{ __('Configurar pontuações') }}</a></li>
    </ul>
    <h3 class="mt-6 text-xl font-semibold">{{ __('Turmas') }}</h3>
    <table class="w-full table-auto">
        <thead><tr><th>{{ __('Nome') }}</th><th>{{ __('Quantidade de alunos') }}</th></tr></thead>
        <tbody>
            @foreach($groups as $g)
                <tr><td>{{ $g->name }}</td><td>{{ $g->users_count }}</td></tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="mt-6 text-xl font-semibold">{{ __('Ranking de Pontos') }}</h3>
    <table class="w-full table-auto">
        <thead><tr><th>{{ __('Aluno') }}</th><th>{{ __('Pontos') }}</th><th>{{ __('Nível') }}</th><th>{{ __('Badge') }}</th></tr></thead>
        <tbody>
            @foreach($ranking as $r)
                <tr>
                    <td>{{ $r['user']->name }}</td>
                    <td>{{ number_format($r['points'],0,__(','),__('.')) }}</td>
                    <td>{{ $r['level'] }}</td>
                    <td>{{ $r['badge'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

