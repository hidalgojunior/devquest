@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded shadow max-w-xl mx-auto">
    <h2 class="text-xl font-semibold mb-4">{{ $activity->exists ? 'Editar atividade' : 'Nova atividade' }}</h2>
    <form method="POST" action="{{ $activity->exists ? route('activities.update',$activity) : route('activities.store') }}">
        @csrf
        @if($activity->exists) @method('PUT') @endif
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
            <label class="block text-sm font-medium">Nome da atividade (nome da pasta no repositório)</label>
            <input name="title" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('title',$activity->title ?? '') }}" required>
            <p class="text-xs text-gray-500 mt-1">Use apenas letras, números, ponto, sublinhado e hífen (sem espaços).</p>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Descrição</label>
            <textarea name="description" class="mt-1 block w-full border-gray-300 rounded-md" required>{{ old('description',$activity->description ?? '') }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Prazo</label>
            <input type="date" name="due_date" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('due_date',$activity->due_date ?? '') }}" required>
        </div>
        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="open_to_all" value="1" class="form-checkbox" {{ old('open_to_all',$activity->open_to_all) ? 'checked' : '' }}>
                <span class="ml-2">Disponível para todas as turmas</span>
            </label>
        </div>
        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_draft" value="1" class="form-checkbox" {{ old('is_draft',$activity->is_draft) ? 'checked' : '' }}>
                <span class="ml-2">Salvar como rascunho (não visível para alunos)</span>
            </label>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Visível a partir de</label>
            <input type="datetime-local" name="visible_from" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('visible_from', optional($activity->visible_from)->format('Y-m-d\TH:i')) }}">
        </div>
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Salvar</button>
    </form>
</div>
@endsection

