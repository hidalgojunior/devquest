@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-lg shadow max-w-md mx-auto">
    <h2 class="text-2xl font-semibold mb-4">Editar configuração</h2>
    <form method="POST" action="{{ route('configurations.update',$config) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-sm font-medium">Chave</label>
            <input class="mt-1 block w-full border-gray-300 rounded-md" value="{{ $config->key }}" disabled>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Valor</label>
            <input name="value" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('value',$config->value) }}" required>
        </div>
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Salvar</button>
    </form>
</div>
@endsection

