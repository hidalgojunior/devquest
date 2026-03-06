@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded shadow max-w-md mx-auto">
    <h2 class="text-xl font-semibold mb-4">{{ __('Registro de aluno') }}</h2>
    @if(session('status'))
        <div class="text-green-600 mb-4">{{ session('status') }}</div>
    @endif
    <form method="POST" action="{{ route('students.register') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium">{{ __('Nome') }}</label>
            <input name="name" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('name') }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">{{ __('RM') }}</label>
            <input name="rm" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('rm') }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">{{ __('E-mail (opcional)') }}</label>
            <input name="email" type="email" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('email') }}">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">{{ __('Senha') }}</label>
            <input name="password" type="password" class="mt-1 block w-full border-gray-300 rounded-md" required>
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded">{{ __('Cadastrar') }}</button>
    </form>
</div>
@endsection

