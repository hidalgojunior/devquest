@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">{{ __('Detalhes da submissão') }}</div>
        <div class="card-body">
            <p><strong>{{ __('Aluno') }}:</strong> {{ $submission->user->name }}</p>
            <p><strong>{{ __('Atividade') }}:</strong> {{ $submission->activity->title }}</p>
            <p><strong>{{ __('GitHub') }}:</strong> <a href="{{ $submission->github_url }}" target="_blank">{{ $submission->github_url }}</a></p>
            <p><strong>{{ __('Data') }}:</strong> {{ $submission->created_at->timezone(auth()->user()->timezone ?? config('app.timezone'))->locale(app()->getLocale())->isoFormat('L LT') }}</p>
        </div>
    </div>
</div>
@endsection

