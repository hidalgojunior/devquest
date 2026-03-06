@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-lg shadow max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">Minhas Presenças</h2>
    <p class="mb-4 text-gray-600">Registros de presença por data.</p>
    <div class="overflow-x-auto">
        <table class="w-full table-auto divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 text-left">Data</th>
                    <th class="py-2 px-4 text-left">Presente</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $rec)
                <tr class="odd:bg-white even:bg-gray-50">
                    <td class="py-2 px-4">{{ \Carbon\Carbon::parse($rec->date)->locale(app()->getLocale())->isoFormat('L') }}</td>
                    <td class="py-2 px-4">{{ $rec->present ? 'Sim' : 'Não' }}</td>
                </tr>
                <tr class="bg-gray-50">
                    <td colspan="2" class="py-2 px-4 text-sm text-gray-600">
                        <strong>Tópico:</strong> {{ $rec->topic ?? '-' }}<br>
                        <strong>Material:</strong> {{ $rec->material ?? '-' }}
                        @if($rec->material_file)
                            <div class="mt-2">
                                <strong>Arquivo:</strong><br>
                                <iframe src="{{ asset('storage/'.$rec->material_file) }}" class="w-full h-64" frameborder="0"></iframe>
                            </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
