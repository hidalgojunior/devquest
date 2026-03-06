@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-4 bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-semibold mb-4">Detalhes da atividade</h2>
    <p><strong>Turma:</strong> {{ $activity->classGroup->name }}</p>
    <p><strong>Título:</strong> {{ $activity->title }}</p>
    <p><strong>Descrição:</strong><br>{{ $activity->description }}</p>
    <p><strong>Prazo:</strong> {{ \Carbon\Carbon::parse($activity->due_date)->locale(app()->getLocale())->isoFormat('L') }}</p>
    <p><strong>Fechada:</strong> {{ $activity->closed ? 'Sim' : 'Não' }}</p>
    <a href="{{ route('activities.index') }}" class="inline-block mt-4 bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">Voltar</a>
</div>
@endsection

