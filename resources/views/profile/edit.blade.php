@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded shadow max-w-md mx-auto">
    <h2 class="text-xl font-semibold mb-4">{{ __('Editar perfil') }}</h2>
    @if(session('status'))
        <div class="text-green-600 mb-4">{{ session('status') }}</div>
    @endif
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="locale" class="block text-sm font-medium">{{ __('Idioma') }}</label>
            <select name="locale" id="locale" class="mt-1 block w-full border-gray-300 rounded-md">
                <option value="pt_BR" {{ $user->locale === 'pt_BR' ? 'selected' : '' }}>{{ __('Português (Brasil)') }}</option>
                <option value="en" {{ $user->locale === 'en' ? 'selected' : '' }}>{{ __('English') }}</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="timezone" class="block text-sm font-medium">{{ __('Fuso horário') }}</label>
            <select name="timezone" id="timezone" class="mt-1 block w-full border-gray-300 rounded-md">
                @foreach(timezone_identifiers_list() as $tz)
                    <option value="{{ $tz }}" {{ $user->timezone === $tz ? 'selected' : '' }}>{{ $tz }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">{{ __('Salvar') }}</button>
    </form>
</div>
@endsection

