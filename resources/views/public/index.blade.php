@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow">
        <h1 class="text-3xl font-bold mb-2">DevQuest</h1>
        <p class="text-gray-600 dark:text-gray-300">Sistema gamificado para gestão da sala de aula em Programação Web II.</p>
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div class="border rounded-md p-3">
                <h3 class="font-semibold mb-1">Como funciona</h3>
                <p>Presenças, entregas e ocorrências compõem a pontuação geral dos alunos, com ranking e badges.</p>
            </div>
            <div class="border rounded-md p-3">
                <h3 class="font-semibold mb-1">Penalidades</h3>
                <ul class="list-disc ml-4">
                    <li>Entrega no prazo: bônus positivo</li>
                    <li>Atrasos: penalidade progressiva</li>
                    <li>Não entrega: desconto maior</li>
                    <li>Ocorrências negativas: desconto adicional</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-3">Painel de pontuação geral</h2>
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="text-left border-b">
                        <th class="py-2">Aluno</th>
                        <th class="py-2">Turma</th>
                        <th class="py-2">Pontos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($overall as $row)
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <td class="py-2">{{ $row['student']->name }}</td>
                            <td class="py-2">{{ $row['student']->classGroup->name ?? '-' }}</td>
                            <td class="py-2 font-semibold">{{ $row['points'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-3">Melhores da Turma A e B por componente</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse($topBySubject as $item)
                <div class="border rounded-md p-4">
                    <h3 class="font-semibold text-lg">{{ $item['subject']->name }}</h3>
                    <p class="mt-2 text-sm"><strong>Turma A:</strong> {{ $item['winnerA']['student']->name ?? '—' }} @if(!empty($item['winnerA'])) ({{ $item['winnerA']['points'] }} pts) @endif</p>
                    <p class="text-sm"><strong>Turma B:</strong> {{ $item['winnerB']['student']->name ?? '—' }} @if(!empty($item['winnerB'])) ({{ $item['winnerB']['points'] }} pts) @endif</p>
                </div>
            @empty
                <p class="text-sm text-gray-500">Ainda não há componentes com ranking por turma.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
