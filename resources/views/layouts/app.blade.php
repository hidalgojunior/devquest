<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevQuest</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 antialiased">
    <!-- utility-first profile navbar -->
    <header class="bg-white shadow fixed w-full z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <button id="sidebar-toggle" class="text-gray-500 focus:outline-none lg:hidden mr-2">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <a href="/" class="text-2xl font-bold text-blue-900">DevQuest</a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                    <div class="relative">
                        <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim(auth()->user()->email))) }}?s=32&d=identicon" alt="" class="h-8 w-8 rounded-full cursor-pointer" id="profile-menu-button">
                        <div id="profile-menu" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden">
                            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="profile-menu-button">
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Meu perfil</a>
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Admin</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Sair</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    @auth
    <!-- sidebar -->
    <div id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out z-20">
        <div class="py-4 px-3">
            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Dashboard</a>
                @if(auth()->user()->isTeacher())
                    <a href="{{ route('students.import.form') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Importar alunos</a>
                    <a href="{{ route('presences.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Presenças</a>
                    <a href="{{ route('activities.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Atividades</a>
                    <a href="{{ route('configurations.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Configurações</a>
                    <a href="{{ route('chat.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Chat</a>
                @else
                    <a href="{{ route('activities.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Atividades</a>
                    <a href="{{ route('presences.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Minhas presenças</a>
                    <a href="{{ route('chat.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Conversa</a>
                @endif
            </nav>
            @if(auth()->user()->isAdmin())
                <hr class="my-4">
                <nav class="space-y-2">
                    <a href="{{ route('admin.teachers') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Gerenciar professores</a>
                    <a href="{{ route('admin.subjects') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Componentes curriculares</a>
                    <a href="{{ route('admin.groups') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Turmas</a>
                </nav>
            @endif
        </div>
    </div>
    @endauth

    <div class="pt-16 lg:pl-64">
        <main class="p-6">
            @yield('content')
        </main>
    </div>

    <!-- error pages placeholder -->
    @yield('modals')

    <script>
        document.getElementById('sidebar-toggle')?.addEventListener('click', function(){
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
        });
        document.getElementById('profile-menu-button')?.addEventListener('click', function(e){
            e.preventDefault();
            document.getElementById('profile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>

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
