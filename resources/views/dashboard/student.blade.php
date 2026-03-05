@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Bem-vindo, {{ $user->name }}</h2>
    <p>Sua pontuação atual: {{ \App\Services\ScoreCalculator::calculateForUser($user) }} pontos</p>
    <!-- more student info can be added here -->
</div>
@endsection