<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevQuest</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-4 px-6 flex items-center justify-between">
            <div class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="DevQuest Logo" class="h-12 mr-4">
                <h1 class="text-2xl font-bold">DevQuest</h1>
            </div>
            @auth
                <button class="md:hidden" onclick="toggleMenu()" aria-label="Toggle menu">
                    <!-- simple hamburger icon -->
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            @endauth
        </div>
        @auth
            <nav id="nav-links" class="hidden md:block bg-gray-200 p-4">
                <div class="max-w-7xl mx-auto flex flex-wrap items-center">
                    <a href="{{ route('dashboard') }}" class="mr-4 text-blue-700 font-semibold">Dashboard</a>
                    @if(auth()->user()->isTeacher())
                        <a href="{{ route('students.import.form') }}" class="mr-4 text-blue-600">Importar alunos</a>
                        <a href="{{ route('presences.index') }}" class="mr-4 text-blue-600">Presenças</a>
                        <a href="{{ route('activities.index') }}" class="mr-4 text-blue-600">Atividades</a>
                        <a href="{{ route('configurations.index') }}" class="mr-4 text-blue-600">Configurações</a>
                    @else
                        <a href="{{ route('activities.index') }}" class="mr-4 text-blue-600">Atividades</a>
                        <a href="{{ route('presences.index') }}" class="mr-4 text-blue-600">Minhas presenças</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600">Sair</button>
                    </form>
                </div>
            </nav>
        @endauth
    </header>

    <main class="py-8">
        <div class="max-w-4xl mx-auto">
            @yield('content')
        </div>
    </main>

    <script>
        function toggleMenu() {
            var links = document.getElementById('nav-links');
            if (links) {
                links.classList.toggle('hidden');
            }
        }
    </script>
</body>
</html>