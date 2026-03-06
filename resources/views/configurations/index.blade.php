@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-lg shadow">
    <h2 class="text-2xl font-semibold mb-4">Configurações de Pontuação</h2>
    @if(session('status'))
        <p class="text-green-600 mb-4">{{ session('status') }}</p>
    @endif
    <div class="overflow-x-auto">
        <table class="w-full table-auto divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 text-left">Chave</th>
                    <th class="py-2 px-4 text-left">Valor</th>
                    <th class="py-2 px-4 text-left">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($configs as $cfg)
                @php
                    $labels = [
                        'point_presence' => 'Ponto por presença',
                        'point_on_time' => 'Ponto por entrega no prazo',
                        'point_missed' => 'Ponto por não entrega',
                        'point_late' => 'Ponto por entrega atrasada',
                        'point_occurrence' => 'Ponto por ocorrência',
                        'point_late_15' => 'Ponto por atraso 15d',
                        'point_late_30' => 'Ponto por atraso 30d',
                        // add others if exist
                    ];
                    $label = $labels[$cfg->key] ?? $cfg->key;
                @endphp
                <tr class="odd:bg-white even:bg-gray-50">
                    <td class="py-2 px-4">{{ $label }}</td>
                    <td class="py-2 px-4">{{ $cfg->value }}</td>
                    <td class="py-2 px-4">
                        <a href="{{ route('configurations.edit',$cfg) }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-1 px-3 rounded-md transition">
                            Editar
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

