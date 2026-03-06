@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">{{ __('Editar configuração') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('configurations.update',$config) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">{{ __('Chave') }}</label>
                    <input class="form-control" value="{{ $config->key }}" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('Valor') }}</label>
                    <input name="value" class="form-control" value="{{ old('value',$config->value) }}" required>
                </div>
                <button class="btn btn-primary">{{ __('Salvar') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection

