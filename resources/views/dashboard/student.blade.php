@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Bem-vindo, {{ $user->name }}</h2>
    <ul class="list-disc pl-5 mb-4">
        <li><a href="{{ route('activities.index') }}" class="text-blue-600">Ver atividades disponíveis</a></li>
        <li><a href="{{ route('presences.index') }}" class="text-blue-600">Registrar presença</a></li>
        <!-- future links: histórico, submissões, perfil -->
    </ul>
    <p>Sua pontuação atual: {{ \App\Services\ScoreCalculator::calculateForUser($user) }} pontos</p>
</div>
@endsection