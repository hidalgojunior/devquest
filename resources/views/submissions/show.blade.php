@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Commits da Submissão {{ $submission->id }}</h2>
    <p>Link: <a href="{{ $submission->github_link }}" target="_blank">{{ $submission->github_link }}</a></p>
    @if($commits->isEmpty())
        <p>Nenhum commit disponível.</p>
    @else
        <table class="w-full table-auto">
            <thead><tr><th>Hash</th><th>Mensagem</th><th>Data</th></tr></thead>
            <tbody>
                @foreach($commits as $c)
                <tr>
                    <td><a href="{{ $c->url }}" target="_blank">{{ $c->commit_hash }}</a></td>
                    <td>{{ $c->message }}</td>
                    <td>{{ $c->committed_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection