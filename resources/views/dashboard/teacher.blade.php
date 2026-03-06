@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">Bem-vindo, {{ $user->name }} (Professor)</h2>
    <p class="text-gray-600">Utilize o menu à esquerda para navegar pelo sistema.</p>
</div>

<div class="mt-6 bg-white p-6 rounded-lg shadow">
    <h3 class="text-xl font-semibold mb-2">Turmas</h3>
    <div class="overflow-x-auto">
        <table class="w-full table-auto divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 text-left">Nome</th>
                    <th class="py-2 px-4 text-left">Quantidade de alunos</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groups as $g)
                <tr class="odd:bg-white even:bg-gray-50">
                    <td class="py-2 px-4">{{ $g->name }}</td>
                    <td class="py-2 px-4">{{ $g->users_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

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
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-xl font-semibold mb-2">Turmas</h3>
        <div class="overflow-x-auto">
            <table class="w-full table-auto divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 text-left">Nome</th>
                        <th class="py-2 px-4 text-left">Quantidade de alunos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($groups as $g)
                    <tr class="odd:bg-white even:bg-gray-50">
                        <td class="py-2 px-4">{{ $g->name }}</td>
                        <td class="py-2 px-4">{{ $g->users_count }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
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
</div>
@endsection

