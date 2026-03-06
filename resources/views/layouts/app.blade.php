<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevQuest</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- optional: include existing Vite assets if needed -->
</head>
<body class="bg-light">
    <nav class="navbar navbar-light bg-white shadow mb-0">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="DevQuest Logo" height="30">
                DevQuest
            </a>
            @auth
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            @endauth
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            @auth
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
                        @if(auth()->user()->isTeacher())
                            <li class="nav-item"><a class="nav-link" href="{{ route('students.import.form') }}">{{ __('Importar alunos') }}</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('presences.index') }}">{{ __('Presenças') }}</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('activities.index') }}">{{ __('Atividades') }}</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('configurations.index') }}">{{ __('Configurações') }}</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('activities.index') }}">{{ __('Atividades') }}</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('presences.index') }}">{{ __('Minhas presenças') }}</a></li>
                        @endif
                        <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">{{ __('Perfil') }}</a></li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">{{ __('Sair') }}</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
            @endauth

            <main class="@auth col-md-9 ms-sm-auto col-lg-10 px-md-4 @else container-fluid @endauth py-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
