@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-semibold mb-4">Professores</h1>
<a href="{{ route('admin.teachers.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">Novo professor</a>
<table class="w-full table-auto divide-y">
    <thead><tr><th>Nome</th><th>E-mail</th></tr></thead>
    <tbody>
        @foreach($teachers as $t)
        <tr class="odd:bg-gray-50 even:bg-white"><td class="px-4 py-2">{{ $t->name }}</td><td class="px-4 py-2">{{ $t->email }}</td></tr>
        @endforeach
    </tbody>
</table>
@endsection
