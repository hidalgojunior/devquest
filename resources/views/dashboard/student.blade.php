@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row gy-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">{{ __('Bem-vindo') }}, {{ $user->name }}</h2>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('activities.index') }}" class="btn btn-outline-primary">{{ __('Ver atividades disponíveis') }}</a>
                        <a href="{{ route('presences.index') }}" class="btn btn-outline-primary">{{ __('Registrar presença') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">{{ __('Sua pontuação atual') }}: <strong>{{ number_format(\App\Services\ScoreCalculator::calculateForUser($user),0,__(','),__('.')) }}</strong> {{ __('pontos') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

