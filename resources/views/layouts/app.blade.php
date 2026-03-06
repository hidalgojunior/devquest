<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevQuest</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 antialiased dark:bg-dark-bg dark:text-gray-200">
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
                    <!-- dark mode toggle -->
                    <button id="dark-toggle" class="p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-700" aria-label="Toggle dark mode">
                        <svg id="icon-sun" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 3.22l.447-.894a1 1 0 011.788 0l.447.894a1 1 0 00.95.553h.995a1 1 0 110 2h-.995a1 1 0 00-.95.553l-.447.894a1 1 0 01-1.788 0l-.447-.894a1 1 0 00-.95-.553H7.755a1 1 0 110-2h.995a1 1 0 00.95-.553z" />
                        </svg>
                        <svg id="icon-moon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-800 hidden" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M17.293 13.293A8 8 0 116.707 2.707a8.003 8.003 0 0010.586 10.586z" />
                        </svg>
                    </button>
                    @auth
                    <div class="relative">
                        <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim(auth()->user()->email))) }}?s=32&d=identicon" alt="" class="h-8 w-8 rounded-full cursor-pointer" id="profile-menu-button">
                        <div id="profile-menu" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 hidden">
                            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="profile-menu-button">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700" role="menuitem">Meu perfil</a>
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700" role="menuitem">Admin</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">Sair</button>
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
        <button id="sidebar-collapse" class="absolute top-2 right-2 p-1 rounded hover:bg-gray-200 dark:hover:bg-gray-700" aria-label="Collapse sidebar">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5" />
            </svg>
        </button>
        <div class="py-4 px-3">
            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-100 flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18v18H3V3z"/></svg><span class="link-text">Dashboard</span></a>
                @if(auth()->user()->isTeacher())
                    <a href="{{ route('students.import.form') }}" class="block px-4 py-2 rounded hover:bg-gray-100 flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="currentColor"><path d="M19 3H5a2 2 0 00-2 2v4h2V5h14v14h-4v2h4a2 2 0 002-2V5a2 2 0 00-2-2z"/></svg><span class="link-text">Importar alunos</span></a>
                    <a href="{{ route('presences.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="link-text">Presenças</span></a>
                    <a href="{{ route('schedules.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V11H3v8a2 2 0 002 2z"/></svg><span class="link-text">Horários</span></a>
                    <a href="{{ route('activities.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100">Atividades</a>
                    <a href="{{ route('configurations.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.1 0-2 .9-2 2s.9 2 2 2m0 0v4m0-4H8m4 0h4"/></svg><span class="link-text">Configurações</span></a>
                    <a href="{{ route('chat.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M3 10h18v6H3z"/></svg><span class="link-text">Chat</span></a>
                @else
                    <a href="{{ route('activities.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M4 4h16v16H4z"/></svg><span class="link-text">Atividades</span></a>
                    <a href="{{ route('presences.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="link-text">Minhas presenças</span></a>
                    <a href="{{ route('chat.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M3 10h18v6H3z"/></svg><span class="link-text">Conversa</span></a>
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

    <style>
        /* collapsed sidebar hides text */
        #sidebar.collapsed nav a .link-text { display: none; }
        #sidebar.collapsed { width: 4rem; }
    </style>
    <script>
        // sidebar toggle (mobile)
        document.getElementById('sidebar-toggle')?.addEventListener('click', function(){
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
        });
        // collapse button inside sidebar
        document.getElementById('sidebar-collapse')?.addEventListener('click', function(){
            document.getElementById('sidebar').classList.toggle('collapsed');
        });
        document.getElementById('profile-menu-button')?.addEventListener('click', function(e){
            e.preventDefault();
            document.getElementById('profile-menu').classList.toggle('hidden');
        });
        // dark mode toggle
        const toggle = document.getElementById('dark-toggle');
        if(toggle){
            const iconSun = document.getElementById('icon-sun');
            const iconMoon = document.getElementById('icon-moon');
            const setMode = mode => {
                if(mode==='dark'){
                    document.documentElement.classList.add('dark');
                    iconSun.classList.add('hidden');
                    iconMoon.classList.remove('hidden');
                } else {
                    document.documentElement.classList.remove('dark');
                    iconSun.classList.remove('hidden');
                    iconMoon.classList.add('hidden');
                }
            };
            let current = localStorage.getItem('theme')|| (window.matchMedia('(prefers-color-scheme: dark)').matches?'dark':'light');
            setMode(current);
            toggle.addEventListener('click',()=>{
                current = document.documentElement.classList.contains('dark')?'light':'dark';
                localStorage.setItem('theme', current);
                setMode(current);
            });
        }
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
