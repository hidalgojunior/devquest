@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-lg shadow max-w-xl mx-auto space-y-6">
    <h2 class="text-2xl font-bold">Bem-vindo, {{ $user->name }}</h2>
    <div class="bg-blue-50 p-6 rounded-md shadow-inner text-center">
        <p class="text-lg">Sua pontuação atual</p>
        <p class="text-4xl font-bold">{{ number_format(\App\Services\ScoreCalculator::calculateForUser($user),0,',','.') }}</p>
    </div>
</div>
@endsection

