@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">{{ __('Importar alunos') }}</div>
        <div class="card-body">
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="file" class="form-label">{{ __('Arquivo XLSX') }}</label>
                    <input type="file" name="file" id="file" class="form-control" required>
                    @error('file')<p class="text-danger small">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection

