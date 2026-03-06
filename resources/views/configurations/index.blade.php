@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">{{ __('Configurações de Pontuação') }}</div>
        <div class="card-body">
            @if(session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead><tr><th>{{ __('Chave') }}</th><th>{{ __('Valor') }}</th><th>{{ __('Ação') }}</th></tr></thead>
                    <tbody>
                        @foreach($configs as $cfg)
                        <tr>
                            <td>{{ $cfg->key }}</td>
                            <td>{{ $cfg->value }}</td>
                            <td><a href="{{ route('configurations.edit',$cfg) }}" class="btn btn-sm btn-outline-primary">{{ __('Editar') }}</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

