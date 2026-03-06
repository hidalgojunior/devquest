@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">{{ __('Registro de Presença') }}</div>
        <div class="card-body">
            @if(session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
            <form method="GET" class="mb-4">
                <div class="row g-2">
                    <div class="col-md-4">
                        <select name="group_id" class="form-select" required>
                            <option value="">{{ __('Selecione a turma') }}</option>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}" {{ $selected==$group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="date" name="date" value="{{ $date }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">{{ __('Carregar') }}</button>
                    </div>
                </div>
            </form>

            @if($students)
                <form method="POST">
                    @csrf
                    <input type="hidden" name="date" value="{{ $date }}">
                    <input type="hidden" name="group_id" value="{{ $selected }}">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr><th>{{ __('RM') }}</th><th>{{ __('Nome') }}</th><th class="text-center">{{ __('Presente') }}</th></tr>
                            </thead>
                            <tbody>
                                @foreach($students as $stu)
                                    <tr>
                                        <td>{{ $stu->rm }}</td>
                                        <td>{{ $stu->name }}</td>
                                        <td class="text-center"><input type="checkbox" name="present[{{ $stu->id }}]" value="1" {{ isset($presences[$stu->id]) && $presences[$stu->id] ? 'checked' : '' }}></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="mt-3 btn btn-success">{{ __('Salvar') }}</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection

