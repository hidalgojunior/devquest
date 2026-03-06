@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">{{ __('Atividades') }}</h2>
        <a href="{{ route('activities.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">{{ __('Nova Atividade') }}</a>
    </div>
    @if(session('status'))<p class="text-green-600 mb-4">{{ session('status') }}</p>@endif
    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead><tr><th>{{ __('Turma') }}</th><th>{{ __('Título') }}</th><th>{{ __('Prazo') }}</th><th>{{ __('Fechada') }}</th><th>{{ __('Ações') }}</th></tr></thead>
            <tbody>
                @foreach($activities as $act)
                <tr>
                    <td>{{ $act->classGroup->name }}</td>
                    <td>{{ $act->title }}</td>
                    <td>{{ \Carbon\Carbon::parse($act->due_date)->locale(app()->getLocale())->isoFormat('L') }}</td>
                    <td>{{ $act->closed ? __('Sim') : __('Não') }}</td>
                    <td class="space-x-2">
                        <a href="{{ route('activities.edit',$act) }}" class="text-blue-600">{{ __('Editar') }}</a>
                        <form action="{{ route('activities.destroy',$act) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600" onclick="return confirm('{{ __('Excluir?') }}')">{{ __('Excluir') }}</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

