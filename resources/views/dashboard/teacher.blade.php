@extends('layouts.app')

@section('content')
<!-- main header area -->
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-blue-900">Painel do Professor</h1>
            <p class="text-gray-600">Visão geral das turmas e ranking</p>
        </div>
        {{-- option buttons could go here if needed --}}
    </div>

    <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white border-l-4 border-blue-600 p-4 rounded-lg shadow">
            <p class="text-sm text-gray-500 uppercase">Turmas</p>
            <p class="text-2xl font-bold">{{ $groups->count() }}</p>
        </div>
        <div class="bg-white border-l-4 border-green-600 p-4 rounded-lg shadow">
            <p class="text-sm text-gray-500 uppercase">Alunos</p>
            <p class="text-2xl font-bold">{{ $totalStudents }}</p>
        </div>
        <div class="bg-white border-l-4 border-yellow-600 p-4 rounded-lg shadow">
            <p class="text-sm text-gray-500 uppercase">Atividades</p>
            <p class="text-2xl font-bold">{{ $totalActivities }}</p>
        </div>
    </div>
</div>

<!-- groups table -->
<div class="mt-6 bg-white p-6 rounded-lg shadow">
    <h3 class="text-xl font-semibold mb-2">Turmas</h3>
    <div class="overflow-x-auto">
        <table class="w-full table-auto divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 text-left">Nome</th>
                    <th class="py-2 px-4 text-left">Alunos</th>
                    <th class="py-2 px-4 text-left">QR aberto?</th>
                    <th class="py-2 px-4 text-left">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groups as $g)
                <tr class="odd:bg-white even:bg-gray-50">
                    <td class="py-2 px-4">{{ $g->name }}</td>
                    <td class="py-2 px-4">{{ $g->users_count }}</td>
                    <td class="py-2 px-4">{{ $g->qr_open ? 'Sim' : 'Não' }}</td>
                    <td class="py-2 px-4">
                        <form method="POST" action="{{ route('class-groups.toggle-qr',$g) }}" class="inline">
                            @csrf
                            <button class="text-sm text-blue-600">{{ $g->qr_open ? 'Fechar QR' : 'Abrir QR' }}</button>
                        </form>
                    </td>
<!-- ranking table -->
<div class="mt-6 bg-white p-6 rounded-lg shadow">
    <h3 class="text-xl font-semibold mb-2">Ranking de Pontos</h3>
    <div class="overflow-x-auto">
        <table class="w-full table-auto divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 text-left">Aluno</th>
                    <th class="py-2 px-4 text-left">Pontos</th>
                    <th class="py-2 px-4 text-left">Nível</th>
                    <th class="py-2 px-4 text-left">Badge</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ranking as $r)
                @php
                    $bg = '';
                    if($loop->first) $bg = 'bg-yellow-100';
                    elseif($loop->index == 1) $bg = 'bg-gray-100';
                    elseif($loop->index == 2) $bg = 'bg-yellow-200';
                @endphp
                <tr class="odd:bg-white even:bg-gray-50 {{ $bg }}">
                    <td class="py-2 px-4 flex items-center">
                        @if($loop->index < 3)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5 4v1a3 3 0 01-3 3H5a3 3 0 01-3-3v-1m6-4V4h6v4"/>
                            </svg>
                        @endif
                        {{ $r['user']->name }}
                    </td>
                    <td class="py-2 px-4">{{ number_format($r['points'],0,',','.') }}</td>
                    <td class="py-2 px-4">{{ $r['level'] }}</td>
                    <td class="py-2 px-4">{{ $r['badge'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

