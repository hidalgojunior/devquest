@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded shadow max-w-md mx-auto">
    <h2 class="text-xl font-semibold mb-4">{{ __('Editar configuração') }}</h2>
    <form method="POST" action="{{ route('configurations.update',$config) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-sm font-medium">{{ __('Chave') }}</label>
            <input class="mt-1 block w-full border-gray-300 rounded-md" value="{{ $config->key }}" disabled>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">{{ __('Valor') }}</label>
            <input name="value" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('value',$config->value) }}" required>
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded">{{ __('Salvar') }}</button>
    </form>
</div>
@endsection

