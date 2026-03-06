@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="DevQuest Logo" class="img-fluid" style="max-height: 80px;">
                    </div>

                    <ul class="nav nav-tabs mb-3" id="loginTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="student-tab" data-bs-toggle="tab" data-bs-target="#student" type="button" role="tab" aria-controls="student" aria-selected="true">{{ __('Aluno') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="teacher-tab" data-bs-toggle="tab" data-bs-target="#teacher" type="button" role="tab" aria-controls="teacher" aria-selected="false">{{ __('Professor') }}</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="student" role="tabpanel" aria-labelledby="student-tab">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <input type="hidden" name="role" value="student">
                                <div class="mb-3">
                                    <label for="rm" class="form-label">{{ __('RM') }}</label>
                                    <input id="rm" name="rm" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('Senha') }}</label>
                                    <input id="password" name="password" type="password" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">{{ __('Entrar') }}</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="teacher" role="tabpanel" aria-labelledby="teacher-tab">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <input type="hidden" name="role" value="teacher">
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('Email') }}</label>
                                    <input id="email" name="email" type="email" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password2" class="form-label">{{ __('Senha') }}</label>
                                    <input id="password2" name="password" type="password" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-success w-100">{{ __('Entrar') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

