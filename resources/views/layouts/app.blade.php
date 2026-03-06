<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevQuest</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-white shadow fixed w-full z-10">
        <div class="max-w-7xl mx-auto py-4 px-6 flex items-center justify-between">
            <span class="text-3xl font-bold text-blue-900">DevQuest</span>
            <div class="flex items-center">
                @auth
                    <button class="md:hidden ml-4" onclick="toggleMenu()" aria-label="Toggle sidebar">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <form method="POST" action="{{ route('logout') }}" class="inline ml-6">
                        @csrf
                        <button type="submit" class="text-red-600">Sair</button>
                    </form>
                @endauth
            </div>
        </div>
    </header>

    @auth
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-10 md:hidden"></div>
    <aside id="sidebar" class="fixed inset-y-0 right-0 w-64 bg-gray-200 p-4 transform translate-x-full md:translate-x-0 transition-transform ease-in-out duration-300 z-30 overflow-y-auto shadow-lg">
        <nav>
            <a href="{{ route('dashboard') }}" class="block mb-2 text-blue-700 font-semibold">Dashboard</a>
            @if(auth()->user()->isTeacher())
                <a href="{{ route('students.import.form') }}" class="block mb-2 text-blue-600">Importar alunos</a>
                <a href="{{ route('presences.index') }}" class="block mb-2 text-blue-600">Presenças</a>
                <a href="{{ route('activities.index') }}" class="block mb-2 text-blue-600">Atividades</a>
                <a href="{{ route('configurations.index') }}" class="block mb-2 text-blue-600">Configurações</a>
            @else
                <a href="{{ route('activities.index') }}" class="block mb-2 text-blue-600">Atividades</a>
                <a href="{{ route('presences.index') }}" class="block mb-2 text-blue-600">Minhas presenças</a>
            @endif
        </nav>
    </aside>
    @endauth

    <div class="pt-20">
        <div class="flex">
            <div class="flex-1 px-6">
                <main class="py-8">
                    <div class="max-w-4xl mx-auto">
                        @yield('content')
                    </div>
                </main>
            </div>
            @auth
                <div class="hidden md:block w-64"></div> <!-- spacer for sidebar right -->
            @endauth
        </div>
    </div>

    <script>
        function toggleMenu() {
            var sidebar = document.getElementById('sidebar');
            var overlay = document.getElementById('overlay');
            if (sidebar) {
                var isOpen = sidebar.classList.toggle('translate-x-full');
                if (overlay) overlay.classList.toggle('hidden');
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            var overlay = document.getElementById('overlay');
            if (overlay) {
                overlay.addEventListener('click', toggleMenu);
            }
        });
    </script>
</body>
</html>
