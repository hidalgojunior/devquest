@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">{{ __('Configurações de Pontuação') }}</h2>
    @if(session('status'))<p class="text-green-600 mb-4">{{ session('status') }}</p>@endif
    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead><tr><th>{{ __('Chave') }}</th><th>{{ __('Valor') }}</th><th>{{ __('Ação') }}</th></tr></thead>
            <tbody>
                @foreach($configs as $cfg)
                <tr>
                    <td>{{ $cfg->key }}</td>
                    <td>{{ $cfg->value }}</td>
                    <td><a href="{{ route('configurations.edit',$cfg) }}" class="text-blue-600">{{ __('Editar') }}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

