@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded shadow max-w-xl mx-auto">
    <h2 class="text-xl font-semibold mb-4">{{ isset($activity) ? 'Editar atividade' : 'Nova atividade' }}</h2>
    <form method="POST" action="{{ isset($activity) ? route('activities.update',$activity) : route('activities.store') }}">
        @csrf
        @if(isset($activity)) @method('PUT') @endif
        <div class="mb-4">
            <label class="block text-sm font-medium">Turma</label>
            <select name="class_group_id" class="mt-1 block w-full border-gray-300 rounded-md" required>
                <option value="">Selecione</option>
                @foreach($groups as $g)
                    <option value="{{ $g->id }}" {{ (old('class_group_id',$activity->class_group_id ?? '')==$g->id)?'selected':'' }}>{{ $g->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Título</label>
            <input name="title" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('title',$activity->title ?? '') }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Descrição</label>
            <textarea name="description" class="mt-1 block w-full border-gray-300 rounded-md" required>{{ old('description',$activity->description ?? '') }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Prazo</label>
            <input type="date" name="due_date" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('due_date',$activity->due_date ?? '') }}" required>
        </div>
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Salvar</button>
    </form>
</div>
@endsection

