@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Atividades</h2>
        <a href="{{ route('activities.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Nova Atividade</a>
    </div>
    @if(session('status'))<p class="text-green-600 mb-4">{{ session('status') }}</p>@endif
    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead><tr><th>Turma</th><th>Título</th><th>Prazo</th><th>Fechada</th><th>Ações</th></tr></thead>
            <tbody>
                @foreach($activities as $act)
                <tr>
                    <td>{{ $act->classGroup->name }}</td>
                    <td>{{ $act->title }}</td>
                    <td>{{ \Carbon\Carbon::parse($act->due_date)->locale(app()->getLocale())->isoFormat('L') }}</td>
                    <td>{{ $act->closed ? 'Sim' : 'Não' }}</td>
                    <td class="space-x-2">
                        <a href="{{ route('activities.edit',$act) }}" class="text-blue-600">Editar</a>
                        <form action="{{ route('activities.destroy',$act) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600" onclick="return confirm('Excluir?')">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

