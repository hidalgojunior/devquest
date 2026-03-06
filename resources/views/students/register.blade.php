@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">{{ __('Registro de aluno') }}</div>
        <div class="card-body">
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            <form method="POST" action="{{ route('students.register') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">{{ __('Nome') }}</label>
                    <input name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('RM') }}</label>
                    <input name="rm" class="form-control" value="{{ old('rm') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('E-mail (opcional)') }}</label>
                    <input name="email" type="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Senha') }}</label>
                    <input name="password" type="password" class="form-control" required>
                </div>
                <button class="btn btn-primary">{{ __('Cadastrar') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection

