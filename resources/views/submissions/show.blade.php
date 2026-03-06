@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded shadow max-w-md mx-auto">
    <h2 class="text-xl font-semibold mb-4">{{ __('Detalhes da submissão') }}</h2>
    <p><strong>{{ __('Aluno') }}:</strong> {{ $submission->user->name }}</p>
    <p><strong>{{ __('Atividade') }}:</strong> {{ $submission->activity->title }}</p>
    <p><strong>{{ __('GitHub') }}:</strong> <a href="{{ $submission->github_url }}" target="_blank" class="text-blue-600 underline">{{ $submission->github_url }}</a></p>
    <p><strong>{{ __('Data') }}:</strong> {{ $submission->created_at->timezone(auth()->user()->timezone ?? config('app.timezone'))->locale(app()->getLocale())->isoFormat('L LT') }}</p>
</div>
@endsection

