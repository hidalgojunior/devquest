@extends('layouts.app')

@section('content')
<div class="bg-white dark:bg-gray-900 p-8 rounded shadow max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-4">Editar perfil</h2>

    @if(session('status'))
        <p class="mb-4 text-green-600">{{ session('status') }}</p>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf
        @method('PUT')

        <div class="md:col-span-2 flex items-center gap-4">
            <img src="{{ $user->avatar_path ? asset('storage/'.$user->avatar_path) : 'https://www.gravatar.com/avatar/'.md5(strtolower(trim($user->email ?? ''))).'?s=96&d=identicon' }}" class="h-20 w-20 rounded-full object-cover border" alt="Avatar">
            <div class="flex-1">
                <label class="block text-sm font-medium">Foto de perfil</label>
                <input type="file" name="avatar" accept="image/*" class="mt-1 block w-full">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium">Nome</label>
            <input name="name" value="{{ old('name',$user->name) }}" class="mt-1 block w-full border rounded-md px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Telefone</label>
            <input name="phone" value="{{ old('phone',$user->phone) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
        </div>

        @if($user->isStudent())
            <div>
                <label class="block text-sm font-medium">CPF</label>
                <input name="cpf" value="{{ old('cpf',$user->cpf) }}" class="mt-1 block w-full border rounded-md px-3 py-2" placeholder="000.000.000-00">
            </div>
        @endif

        <div>
            <label class="block text-sm font-medium">GitHub (usuário)</label>
            <input name="github_username" value="{{ old('github_username',$user->github_username) }}" class="mt-1 block w-full border rounded-md px-3 py-2" placeholder="usuario">
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium">Repositório principal de entregas</label>
            <input name="github_repository" value="{{ old('github_repository',$user->github_repository) }}" class="mt-1 block w-full border rounded-md px-3 py-2" placeholder="nome-do-repositorio (se vazio, usa o nome do usuário)">
            <p class="text-xs text-gray-500 mt-1">As atividades usam o nome da atividade como nome da pasta dentro do repositório.</p>
        </div>

        @if($user->isTeacher() || $user->isAdmin())
            <div>
                <label class="block text-sm font-medium">Instagram</label>
                <input name="instagram" value="{{ old('instagram',$user->instagram) }}" class="mt-1 block w-full border rounded-md px-3 py-2" placeholder="@seuusuario">
            </div>

            <div>
                <label class="block text-sm font-medium">WhatsApp</label>
                <input name="whatsapp" value="{{ old('whatsapp',$user->whatsapp) }}" class="mt-1 block w-full border rounded-md px-3 py-2" placeholder="(11) 99999-9999">
            </div>
        @endif

        <div class="md:col-span-2">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Salvar perfil</button>
        </div>
    </form>
</div>
@endsection

