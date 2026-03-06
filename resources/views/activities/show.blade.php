@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">{{ __('Detalhes da atividade') }}</div>
        <div class="card-body">
            <p><strong>{{ __('Turma') }}:</strong> {{ $activity->classGroup->name }}</p>
            <p><strong>{{ __('Título') }}:</strong> {{ $activity->title }}</p>
            <p><strong>{{ __('Descrição') }}:</strong><br>{{ $activity->description }}</p>
            <p><strong>{{ __('Prazo') }}:</strong> {{ \Carbon\Carbon::parse($activity->due_date)->locale(app()->getLocale())->isoFormat('L') }}</p>
            <p><strong>{{ __('Fechada') }}:</strong> {{ $activity->closed ? __('Sim') : __('Não') }}</p>
            <a href="{{ route('activities.index') }}" class="btn btn-secondary">{{ __('Voltar') }}</a>
        </div>
    </div>
</div>
@endsection

