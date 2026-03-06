@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded shadow max-w-md mx-auto mt-12">
    <div class="flex justify-center mb-6">
        <img src="{{ asset('images/logo.png') }}" alt="DevQuest Logo" class="h-16">
    </div>

    <div class="mb-4">
        <nav class="flex space-x-4" aria-label="Tabs">
            <a href="#student" class="tab-link px-3 py-2 font-medium text-sm rounded-md bg-blue-100" data-target="student">Aluno</a>
            <a href="#teacher" class="tab-link px-3 py-2 font-medium text-sm rounded-md text-gray-500 hover:text-gray-700" data-target="teacher">Professor</a>
        </nav>
    </div>

    <div id="student" class="tab-content">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="hidden" name="role" value="student">
            <div class="mb-4">
                <label for="rm" class="block text-sm font-medium">RM</label>
                <input id="rm" name="rm" type="text" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium">Senha</label>
                <input id="password" name="password" type="password" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md">Entrar</button>
        </form>
    </div>

    <div id="teacher" class="tab-content hidden">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="hidden" name="role" value="teacher">
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium">Email</label>
                <input id="email" name="email" type="email" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>
            <div class="mb-4">
                <label for="password2" class="block text-sm font-medium">Senha</label>
                <input id="password2" name="password" type="password" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>
            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-md">Entrar</button>
        </form>
    </div>
</div>

<script>
    document.querySelectorAll('.tab-link').forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            document.querySelectorAll('.tab-link').forEach(l => l.classList.remove('bg-blue-100', 'text-gray-500'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.add('hidden'));
            const target = link.getAttribute('data-target');
            link.classList.add('bg-blue-100');
            document.getElementById(target).classList.remove('hidden');
        });
    });
</script>
@endsection

