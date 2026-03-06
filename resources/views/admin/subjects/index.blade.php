@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-semibold mb-4">Componentes Curriculares</h1>
<a href="{{ route('admin.subjects.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">Nova matéria</a>
<ul class="list-disc pl-5">
    @foreach($subjects as $s)
        <li>{{ $s->name }}</li>
    @endforeach
</ul>
@endsection
