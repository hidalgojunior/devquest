@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">{{ __('Registro de Presença') }}</h2>
    @if(session('status'))<p class="text-green-600 mb-4">{{ session('status') }}</p>@endif
    <form method="GET" class="mb-4">
        <div class="flex gap-4 flex-wrap">
            <select name="group_id" class="border rounded p-2" required>
                <option value="">{{ __('Selecione a turma') }}</option>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}" {{ $selected==$group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                @endforeach
            </select>
            <input type="date" name="date" value="{{ $date }}" class="border rounded p-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">{{ __('Carregar') }}</button>
        </div>
    </form>

    @if($students)
        <form method="POST">
            @csrf
            <input type="hidden" name="date" value="{{ $date }}">
            <input type="hidden" name="group_id" value="{{ $selected }}">
            <table class="w-full table-auto">
                <thead>
                    <tr><th>{{ __('RM') }}</th><th>{{ __('Nome') }}</th><th class="text-center">{{ __('Presente') }}</th></tr>
                </thead>
                <tbody>
                    @foreach($students as $stu)
                        <tr>
                            <td>{{ $stu->rm }}</td>
                            <td>{{ $stu->name }}</td>
                            <td class="text-center"><input type="checkbox" name="present[{{ $stu->id }}]" value="1" {{ isset($presences[$stu->id]) && $presences[$stu->id] ? 'checked' : '' }}></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="mt-4 bg-green-600 text-white px-4 py-2 rounded">{{ __('Salvar') }}</button>
        </form>
    @endif
</div>
@endsection

