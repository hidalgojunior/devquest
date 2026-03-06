@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">{{ __('Bem-vindo') }}, {{ $user->name }}</h2>
    <p>{{ __('Sua pontuação atual') }}: <strong>{{ number_format(\App\Services\ScoreCalculator::calculateForUser($user),0,__(','),__('.')) }}</strong> {{ __('pontos') }}</p>
</div>
@endsection

