@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-semibold mb-4">Cadastrar professor</h1>
<form method="POST" class="space-y-4">
    @csrf
    <x-form-field label="Nome" name="name" />
    <x-form-field label="E-mail" name="email" type="email" />
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Salvar</button>
</form>
@endsection
