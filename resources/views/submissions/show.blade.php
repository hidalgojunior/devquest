@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded shadow max-w-md mx-auto">
    <h2 class="text-xl font-semibold mb-4">Detalhes da submissão</h2>
    <p><strong>Aluno:</strong> {{ $submission->user->name }}</p>
    <p><strong>Atividade:</strong> {{ $submission->activity->title }}</p>
    <p><strong>GitHub:</strong> <a href="{{ $submission->github_link }}" target="_blank" class="text-blue-600 underline">{{ $submission->github_link }}</a></p>
    <p><strong>Usuário GitHub:</strong> {{ $submission->user->github_username ?? '-' }}</p>
    <p><strong>Repositório:</strong> {{ $submission->user->github_repository ?: ($submission->user->github_username ?? '-') }}</p>
    <p><strong>Pasta da atividade:</strong> {{ $submission->activity->title }}</p>
    <p><strong>Data:</strong> {{ $submission->created_at->timezone(auth()->user()->timezone ?? config('app.timezone'))->locale(app()->getLocale())->isoFormat('L LT') }}</p>
</div>
@endsection

