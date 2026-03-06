@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-lg shadow max-w-md mx-auto">
    <h2 class="text-2xl font-bold mb-4">Chamada</h2>
    <p>Data: {{ \Carbon\Carbon::parse($date)->locale(app()->getLocale())->isoFormat('L') }}</p>

    @if(is_null($present))
        <form method="POST" action="{{ route('presences.store') }}">
            @csrf
            <input type="hidden" name="group_id" value="{{ auth()->user()->class_group_id }}">
            <input type="hidden" name="date" value="{{ $date }}">
            <div class="mt-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="present[{{ auth()->user()->id }}]" value="1" class="form-checkbox">
                    <span class="ml-2">Estou presente</span>
                </label>
            </div>
            <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-md">Registrar</button>
        </form>
    @else
        <p class="mt-4">Você já marcou presença como <strong>{{ $present ? 'presente' : 'ausente' }}</strong>.</p>
    @endif
</div>
@endsection
