@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Dashboard</h2>
            <p>Bem-vindo, {{ auth()->user()->name }}!</p>
        </div>
    </div>
</div>
@endsection

