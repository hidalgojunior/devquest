@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-semibold mb-4">Nova matéria</h1>
<form method="POST" class="space-y-4">
    @csrf
    <x-form-field label="Nome" name="name" />
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Criar</button>
</form>
@endsection
