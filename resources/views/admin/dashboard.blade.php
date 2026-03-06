@extends('layouts.app')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <x-widget title="Professores">{{ \\App\\Models\\User::where('role','teacher')->count() }}</x-widget>
    <x-widget title="Turmas">{{ \\App\\Models\\ClassGroup::count() }}</x-widget>
    <x-widget title="Matérias">{{ \\App\\Models\\Subject::count() }}</x-widget>
</div>
@endsection