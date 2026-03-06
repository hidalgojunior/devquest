<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevQuest</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 antialiased dark:bg-gray-950 dark:text-gray-100">
    <header class="bg-white/95 dark:bg-gray-900/95 border-b border-gray-200 dark:border-gray-800 fixed w-full z-30 backdrop-blur">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                @auth
                    <button id="sidebar-toggle" class="lg:hidden p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-800" aria-label="Abrir menu">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                @endauth
                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-blue-700 dark:text-blue-400">DevQuest</a>
            </div>

            <div class="flex items-center gap-3">
                <button id="dark-toggle" class="p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-800" aria-label="Alternar tema">
                    <svg id="icon-sun" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor"><path d="M10 3.22l.447-.894a1 1 0 011.788 0l.447.894a1 1 0 00.95.553h.995a1 1 0 110 2h-.995a1 1 0 00-.95.553l-.447.894a1 1 0 01-1.788 0l-.447-.894a1 1 0 00-.95-.553H7.755a1 1 0 110-2h.995a1 1 0 00.95-.553z" /></svg>
                    <svg id="icon-moon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden text-gray-200" viewBox="0 0 20 20" fill="currentColor"><path d="M17.293 13.293A8 8 0 116.707 2.707a8.003 8.003 0 0010.586 10.586z" /></svg>
                </button>

                @auth
                <div class="relative">
                    <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim(auth()->user()->email ?? ''))) }}?s=32&d=identicon" alt="avatar" class="h-8 w-8 rounded-full cursor-pointer ring-2 ring-blue-500/30" id="profile-menu-button">
                    <div id="profile-menu" class="hidden absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-800">Meu perfil</a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-800">Admin</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-800">Sair</button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </header>

    @auth
    <aside id="sidebar" class="fixed top-16 left-0 bottom-0 w-64 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 transform -translate-x-full lg:translate-x-0 transition-transform z-20 overflow-y-auto">
        <div class="p-3">
            <button id="sidebar-collapse" class="hidden lg:inline-flex mb-2 p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-800" aria-label="Recolher barra lateral">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5" /></svg>
            </button>

            <nav class="space-y-1 text-sm">
                <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                @if(auth()->user()->isTeacher())
                    <a href="{{ route('students.import.form') }}" class="nav-link">Importar alunos</a>
                    <a href="{{ route('presences.index') }}" class="nav-link">Presenças</a>
                    <a href="{{ route('schedules.index') }}" class="nav-link">Horários</a>
                    <a href="{{ route('activities.index') }}" class="nav-link">Atividades</a>
                    <a href="{{ route('configurations.index') }}" class="nav-link">Configurações</a>
                    <a href="{{ route('chat.index') }}" class="nav-link">Chat</a>
                @else
                    <a href="{{ route('activities.index') }}" class="nav-link">Atividades</a>
                    <a href="{{ route('presences.index') }}" class="nav-link">Minhas presenças</a>
                    <a href="{{ route('chat.index') }}" class="nav-link">Conversa</a>
                @endif
            </nav>

            @if(auth()->user()->isAdmin())
                <hr class="my-3 border-gray-200 dark:border-gray-800">
                <nav class="space-y-1 text-sm">
                    <a href="{{ route('admin.teachers') }}" class="nav-link">Gerenciar professores</a>
                    <a href="{{ route('admin.subjects') }}" class="nav-link">Componentes curriculares</a>
                    <a href="{{ route('admin.groups') }}" class="nav-link">Turmas</a>
                </nav>
            @endif
        </div>
    </aside>
    @endauth

    <div class="pt-16 @auth lg:pl-64 @endauth">
        <main class="p-6">
            @yield('content')
        </main>
    </div>

    @yield('modals')

    <style>
        .nav-link {
            display: block;
            padding: .5rem .75rem;
            border-radius: .5rem;
            color: #374151;
        }
        .dark .nav-link { color: #e5e7eb; }
        .nav-link:hover { background: #f3f4f6; }
        .dark .nav-link:hover { background: #1f2937; }
        #sidebar.collapsed { width: 4.25rem; }
        #sidebar.collapsed .nav-link { white-space: nowrap; overflow: hidden; text-overflow: clip; font-size: 0; }
    </style>

    <script>
        const html = document.documentElement;
        const toggle = document.getElementById('dark-toggle');
        const iconSun = document.getElementById('icon-sun');
        const iconMoon = document.getElementById('icon-moon');

        const applyTheme = (mode) => {
            if (mode === 'dark') {
                html.classList.add('dark');
                iconSun?.classList.add('hidden');
                iconMoon?.classList.remove('hidden');
            } else {
                html.classList.remove('dark');
                iconSun?.classList.remove('hidden');
                iconMoon?.classList.add('hidden');
            }
        };

        applyTheme(localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'));

        toggle?.addEventListener('click', () => {
            const next = html.classList.contains('dark') ? 'light' : 'dark';
            localStorage.setItem('theme', next);
            applyTheme(next);
        });

        document.getElementById('sidebar-toggle')?.addEventListener('click', () => {
            document.getElementById('sidebar')?.classList.toggle('-translate-x-full');
        });

        document.getElementById('sidebar-collapse')?.addEventListener('click', () => {
            document.getElementById('sidebar')?.classList.toggle('collapsed');
        });

        document.getElementById('profile-menu-button')?.addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('profile-menu')?.classList.toggle('hidden');
        });
    </script>
</body>
</html>
