@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-4">Bem-vindo, {{ $user->name }}</h2>
        <ul class="flex flex-wrap gap-4 mb-2">
            <li><a href="{{ route('activities.index') }}" class="px-4 py-2 bg-blue-100 hover:bg-blue-200 rounded">Ver atividades disponíveis</a></li>
            <li><a href="{{ route('presences.index') }}" class="px-4 py-2 bg-blue-100 hover:bg-blue-200 rounded">Registrar presença</a></li>
        </ul>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6">
        <p class="text-lg">Sua pontuação atual: <span class="font-semibold">{{ \App\Services\ScoreCalculator::calculateForUser($user) }}</span> pontos</p>
    </div>
</div>
@endsection