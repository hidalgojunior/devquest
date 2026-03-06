@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-semibold mb-4">Turmas</h1>
<a href="{{ route('admin.groups.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">Nova turma</a>
<ul class="list-disc pl-5">
    @foreach($groups as $g)
        <li>{{ $g->name }}</li>
    @endforeach
</ul>
@endsection
