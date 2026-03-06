@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ __('Dashboard') }}</h2>
            <p>{{ __('Bem-vindo') }}, {{ auth()->user()->name }}!</p>
        </div>
    </div>
</div>
@endsection

