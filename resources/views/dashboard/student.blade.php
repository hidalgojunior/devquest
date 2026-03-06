@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-lg shadow max-w-xl mx-auto space-y-6">
    <h2 class="text-2xl font-bold">Bem-vindo, {{ $user->name }}</h2>
    <div class="bg-blue-50 p-6 rounded-md shadow-inner text-center">
        <p class="text-lg">Sua pontuação atual</p>
        <p class="text-4xl font-bold">{{ number_format(\App\Services\ScoreCalculator::calculateForUser($user),0,',','.') }}</p>
    </div>
    <div class="mt-6">
        <h3 class="text-xl font-semibold mb-2">Minhas submissões</h3>
        <div class="overflow-x-auto">
            <table class="w-full table-auto divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4">Atividade</th>
                        <th class="py-2 px-4">Data</th>
                        <th class="py-2 px-4">GitHub</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->submissions as $s)
                    <tr class="odd:bg-white even:bg-gray-50">
                        <td class="py-2 px-4">{{ $s->activity->title ?? '-' }}</td>
                        <td class="py-2 px-4">{{ \Carbon\Carbon::parse($s->created_at)->locale(app()->getLocale())->isoFormat('L LTS') }}</td>
                        <td class="py-2 px-4"><a href="{{ $s->github_url }}" target="_blank" class="text-blue-600 underline">ver</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

