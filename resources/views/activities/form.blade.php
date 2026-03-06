@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">{{ isset($activity) ? __('Editar atividade') : __('Nova atividade') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ isset($activity) ? route('activities.update',$activity) : route('activities.store') }}">
                @csrf
                @if(isset($activity)) @method('PUT') @endif
                <div class="mb-3">
                    <label class="form-label">{{ __('Turma') }}</label>
                    <select name="class_group_id" class="form-select" required>
                        <option value="">{{ __('Selecione') }}</option>
                        @foreach($groups as $g)
                            <option value="{{ $g->id }}" {{ (old('class_group_id',$activity->class_group_id ?? '')==$g->id)?'selected':'' }}>{{ $g->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Título') }}</label>
                    <input name="title" class="form-control" value="{{ old('title',$activity->title ?? '') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Descrição') }}</label>
                    <textarea name="description" class="form-control" required>{{ old('description',$activity->description ?? '') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Prazo') }}</label>
                    <input type="date" name="due_date" class="form-control" value="{{ old('due_date',$activity->due_date ?? '') }}" required>
                </div>
                <button class="btn btn-primary">{{ __('Salvar') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection

