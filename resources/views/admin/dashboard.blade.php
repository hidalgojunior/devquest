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