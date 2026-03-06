@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            {{ __('Editar perfil') }}
        </div>
        <div class="card-body">
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="locale" class="form-label">{{ __('Idioma') }}</label>
                    <select name="locale" id="locale" class="form-select">
                        <option value="pt_BR" {{ $user->locale === 'pt_BR' ? 'selected' : '' }}>{{ __('Português (Brasil)') }}</option>
                        <option value="en" {{ $user->locale === 'en' ? 'selected' : '' }}>{{ __('English') }}</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="timezone" class="form-label">{{ __('Fuso horário') }}</label>
                    <select name="timezone" id="timezone" class="form-select">
                        @foreach(timezone_identifiers_list() as $tz)
                            <option value="{{ $tz }}" {{ $user->timezone === $tz ? 'selected' : '' }}>{{ $tz }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
