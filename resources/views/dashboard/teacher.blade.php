@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row gy-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">{{ __('Bem-vindo') }}, {{ $user->name }} ({{ __('Professor') }})</h2>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('students.import.form') }}" class="btn btn-outline-primary">{{ __('Importar alunos') }}</a>
                        <a href="{{ route('students.register.form') }}" class="btn btn-outline-primary">{{ __('Registrar aluno manualmente') }}</a>
                        <a href="{{ route('presences.index') }}" class="btn btn-outline-primary">{{ __('Marcar presenças') }}</a>
                        <a href="{{ route('activities.index') }}" class="btn btn-outline-primary">{{ __('Gerenciar atividades') }}</a>
                        <a href="{{ route('configurations.index') }}" class="btn btn-outline-secondary">{{ __('Configurar pontuações') }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ __('Turmas') }}</h3>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead><tr><th>{{ __('Nome') }}</th><th>{{ __('Quantidade de alunos') }}</th></tr></thead>
                            <tbody>
                                @foreach($groups as $g)
                                    <tr><td>{{ $g->name }}</td><td>{{ $g->users_count }}</td></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ __('Ranking de Pontos') }}</h3>
                    <div class="table-responsive">
                        <table class="table table-striped">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

