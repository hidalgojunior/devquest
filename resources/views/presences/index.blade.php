@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-lg shadow">
    <h2 class="text-xl font-semibold mb-4">Registro de Presença</h2>
    @if(session('status'))
        <p class="text-green-600 mb-4">{{ session('status') }}</p>
    @endif
    <form method="GET" class="mb-4">
        <div class="flex flex-wrap gap-4 items-end">
            <select name="group_id" class="border rounded-md p-2" required>
                <option value="">Selecione a turma</option>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}" {{ $selected==$group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                @endforeach
            </select>
            <input type="date" name="date" value="{{ $date }}" class="border rounded-md p-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Carregar</button>
        </div>
    </form>

    @if($students)
        <form method="POST">
            @csrf
            <input type="hidden" name="date" value="{{ $date }}">
            <input type="hidden" name="group_id" value="{{ $selected }}">
            <div class="overflow-x-auto">
                <table class="w-full table-auto divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr><th class="py-2 px-4">RM</th><th class="py-2 px-4">Nome</th><th class="py-2 px-4 text-center">Presente</th></tr>
                    </thead>
                    <tbody>
                        @foreach($students as $stu)
                            <tr class="odd:bg-white even:bg-gray-50">
                                <td class="py-2 px-4">{{ $stu->rm }}</td>
                                <td class="py-2 px-4">{{ $stu->name }}</td>
                                <td class="text-center"><input type="checkbox" name="present[{{ $stu->id }}]" value="1" {{ isset($presences[$stu->id]) && $presences[$stu->id] ? 'checked' : '' }}></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="submit" class="mt-4 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">Salvar</button>
        </form>
    @endif
</div>
@endsection

