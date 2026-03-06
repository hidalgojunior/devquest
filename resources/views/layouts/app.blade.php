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
            <div class="flex items-center">
                <button class="md:hidden mr-4" onclick="toggleMenu()" aria-label="Toggle sidebar">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <img src="{{ asset('images/logo.png') }}" alt="DevQuest Logo" class="h-12 mr-4">
                <h1 class="text-2xl font-bold">DevQuest</h1>
            </div>
            @auth
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600">Sair</button>
                </form>
            @endauth
        </div>
    </header>

    @auth
    <aside id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-gray-200 p-4 transform -translate-x-full md:translate-x-0 transition-transform ease-in-out duration-300 z-20 overflow-y-auto">
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
            @auth
                <div class="hidden md:block w-64"></div> <!-- spacer for sidebar -->
            @endauth
            <div class="flex-1 px-6">
                <main class="py-8">
                    <div class="max-w-4xl mx-auto">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
    </div>

    <script>
        function toggleMenu() {
            var sidebar = document.getElementById('sidebar');
            if (sidebar) {
                sidebar.classList.toggle('-translate-x-full');
            }
        }
    </script>
</body>
</html>
