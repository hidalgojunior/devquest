@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded shadow max-w-lg mx-auto">
    <h2 class="text-xl font-semibold mb-6">Cadastro de Aluno</h2>

    @if(session('status'))
        <div class="mb-4 text-green-600">{{ session('status') }}</div>
    @endif

    <form action="{{ route('students.register') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="rm" class="block text-sm font-medium">RM</label>
            <input id="rm" name="rm" type="text" value="{{ old('rm') }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            @error('rm')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Nome completo</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            @error('name')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label for="cpf" class="block text-sm font-medium">CPF</label>
            <input id="cpf" name="cpf" type="text" value="{{ old('cpf') }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            @error('cpf')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium">Telefone</label>
            <input id="phone" name="phone" type="text" value="{{ old('phone') }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            @error('phone')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label for="birthdate" class="block text-sm font-medium">Data de Nascimento</label>
            <input id="birthdate" name="birthdate" type="date" value="{{ old('birthdate') }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            @error('birthdate')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label for="github_username" class="block text-sm font-medium">Usuário GitHub</label>
            <input id="github_username" name="github_username" type="text" value="{{ old('github_username') }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            @error('github_username')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label for="class_group_id" class="block text-sm font-medium">Turma</label>
            <select id="class_group_id" name="class_group_id" class="mt-1 block w-full border-gray-300 rounded-md" required>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}" {{ old('class_group_id') == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                @endforeach
            </select>
            @error('class_group_id')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Registrar</button>
    </form>
</div>
@endsection