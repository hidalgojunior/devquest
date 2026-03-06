@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>{{ __('Atividades') }}</h2>
        <a href="{{ route('activities.create') }}" class="btn btn-primary">{{ __('Nova Atividade') }}</a>
    </div>
    @if(session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr><th>{{ __('Turma') }}</th><th>{{ __('Título') }}</th><th>{{ __('Prazo') }}</th><th>{{ __('Fechada') }}</th><th>{{ __('Ações') }}</th></tr>
            </thead>
            <tbody>
                @foreach($activities as $act)
                <tr>
                    <td>{{ $act->classGroup->name }}</td>
                    <td>{{ $act->title }}</td>
                    <td>{{ \Carbon\Carbon::parse($act->due_date)->locale(app()->getLocale())->isoFormat('L') }}</td>
                    <td>{{ $act->closed ? __('Sim') : __('Não') }}</td>
                    <td>
                        <a href="{{ route('activities.edit',$act) }}" class="btn btn-sm btn-outline-secondary">{{ __('Editar') }}</a>
                        <form action="{{ route('activities.destroy',$act) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('{{ __('Excluir?') }}')">{{ __('Excluir') }}</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

