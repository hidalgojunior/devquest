@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-semibold mb-4">Novo horário</h1>
<form method="POST" class="space-y-4">
    @csrf
    <x-form-field label="Dia" name="day_of_week" type="select" :options="$days" />
    <x-form-field label="Hora de início" name="start_time" type="select" :options=array_combine($times,$times) />
    <x-form-field label="Componente" name="subject_id" type="select" :options=$subjects->pluck('name','id')->toArray() />
    <x-form-field label="Turma" name="class_group_id" type="select" :options=$groups->pluck('name','id')->toArray() />
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Salvar</button>
</form>
@endsection