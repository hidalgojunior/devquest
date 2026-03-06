@extends('layouts.app')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <x-widget title="Professores">{{ \\App\\Models\\User::where('role','teacher')->count() }}</x-widget>
    <x-widget title="Turmas">{{ \\App\\Models\\ClassGroup::count() }}</x-widget>
    <x-widget title="Matérias">{{ \\App\\Models\\Subject::count() }}</x-widget>
</div>

<!-- upcoming schedule widget -->
@php
    $next = \\App\\Models\\Schedule::where('start_time','>=',now()->format('H:i'))->orderBy('start_time')->first();
@endphp
@if($next)
    <div class="mb-6">
        <x-tile>
            <div class="text-sm text-gray-500">Próxima aula</div>
            <div class="text-xl font-bold">{{ ucfirst($next->day_of_week) }} - {{ $next->start_time }}</div>
            <div class="text-sm">{{ $next->classGroup->name }} | {{ $next->subject->name }}</div>
        </x-tile>
    </div>
@endif

<!-- schedule chart -->
<div class="bg-white rounded-lg p-4 shadow">
    <h3 class="text-lg font-semibold mb-2">Aulas por dia</h3>
    <canvas id="scheduleChart" class="w-full h-48"></canvas>
</div>

<div class="mt-6 bg-white rounded-lg p-4 shadow border border-red-200">
    <h3 class="text-lg font-semibold text-red-700">Apagar dados de teste</h3>
    <p class="text-sm text-gray-600 mb-3">Ação administrativa: remove dados operacionais de teste (alunos, turmas, componentes, atividades, presenças, chats, submissões e commits).</p>
    @if($errors->has('admin_secret'))
        <p class="text-sm text-red-600 mb-2">{{ $errors->first('admin_secret') }}</p>
    @endif
    @if(session('status'))
        <p class="text-sm text-green-600 mb-2">{{ session('status') }}</p>
    @endif
    <form method="POST" action="{{ route('admin.purge-test-data') }}" class="flex flex-col sm:flex-row gap-2">
        @csrf
        <input type="password" name="admin_secret" placeholder="Informe a senha de autorização" class="border rounded px-3 py-2 flex-1" required>
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded" onclick="return confirm('Confirma apagar os dados de teste?')">Apagar dados</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded',function(){
        const data = {
            labels: ['Seg','Ter','Qua','Qui','Sex'],
            datasets: [{
                label: 'Quantidade de aulas',
                data: [
                    {{ \\App\\Models\\Schedule::where('day_of_week','monday')->count() }},
                    {{ \\App\\Models\\Schedule::where('day_of_week','tuesday')->count() }},
                    {{ \\App\\Models\\Schedule::where('day_of_week','wednesday')->count() }},
                    {{ \\App\\Models\\Schedule::where('day_of_week','thursday')->count() }},
                    {{ \\App\\Models\\Schedule::where('day_of_week','friday')->count() }},
                ],
                backgroundColor: 'rgba(30,136,229,0.6)',
                borderColor: 'rgba(30,136,229,1)',
                borderWidth:1
            }]
        };
        const ctx = document.getElementById('scheduleChart');
        new Chart(ctx,{type:'bar',data:data,options:{responsive:true,plugins:{legend:{display:false}},scales:{y:{beginAtZero:true}}}});
    });
</script>
@endsection