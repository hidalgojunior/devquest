@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded shadow max-w-md mx-auto">
    <h2 class="text-xl font-semibold mb-4">Registro de aluno</h2>
    @if(session('status'))
        <div class="text-green-600 mb-4">{{ session('status') }}</div>
    @endif
    <form method="POST" action="{{ route('students.register') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium">Nome</label>
            <input name="name" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('name') }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">RM</label>
            <input name="rm" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('rm') }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">CPF</label>
            <input id="cpf" name="cpf" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('cpf') }}" placeholder="000.000.000-00" pattern="^(\d{3}\.\d{3}\.\d{3}-\d{2}|\d{11})$" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Telefone</label>
            <input id="phone" name="phone" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('phone') }}" placeholder="(11) 98888-7777" pattern="^(\(\d{2}\)\s?\d{4,5}-\d{4}|\d{10,11})$" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Data de nascimento</label>
            <input name="birthdate" type="date" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('birthdate') }}" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Usuário GitHub</label>
            <input name="github_username" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('github_username') }}" placeholder="seuusuario" required>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium">Turma</label>
            <select name="class_group_id" class="mt-1 block w-full border-gray-300 rounded-md" required>
                <option value="">Selecione...</option>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}" {{ old('class_group_id') == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                @endforeach
            </select>
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded">Cadastrar</button>
    </form>
</div>

<script>
    const onlyDigits = (value) => value.replace(/\D/g, '');
    const maskCpf = (value) => {
        const d = onlyDigits(value).slice(0,11);
        return d.replace(/(\d{3})(\d)/, '$1.$2').replace(/(\d{3})(\d)/, '$1.$2').replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    };
    const maskPhone = (value) => {
        const d = onlyDigits(value).slice(0,11);
        if (d.length <= 10) return d.replace(/(\d{2})(\d)/, '($1) $2').replace(/(\d{4})(\d{1,4})$/, '$1-$2');
        return d.replace(/(\d{2})(\d)/, '($1) $2').replace(/(\d{5})(\d{1,4})$/, '$1-$2');
    };
    document.getElementById('cpf')?.addEventListener('input', (e) => e.target.value = maskCpf(e.target.value));
    document.getElementById('phone')?.addEventListener('input', (e) => e.target.value = maskPhone(e.target.value));
</script>
@endsection

