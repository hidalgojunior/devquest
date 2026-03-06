@extends('layouts.app')

@section('content')
<!-- menubar / breadcrumb -->
<nav class="bg-white p-4 shadow flex items-center justify-between">
    <ul class="flex items-center space-x-2 text-sm text-gray-600">
        <li><a href="/dashboard" class="hover:underline">Home</a></li>
        <li>›</li>
        <li><a href="{{ route('presences.index') }}" class="hover:underline font-semibold">Presenças</a></li>
    </ul>
    <div class="flex items-center space-x-4">
        <span class="text-xs text-gray-500">Professor:</span>
        <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim(auth()->user()->email))) }}?s=32&d=identicon" alt="avatar" class="rounded-full">
        <!-- social buttons -->
        <div class="flex space-x-2">
            <a href="https://github.com/{{ auth()->user()->github_username ?? '' }}" target="_blank" class="text-gray-600 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .5C5.648.5.5 5.648.5 12c0 5.084 3.292 9.392 7.864 10.915.575.106.785-.25.785-.556 0-.275-.01-1.005-.015-1.975-3.2.695-3.875-1.543-3.875-1.543-.523-1.328-1.277-1.681-1.277-1.681-1.044-.714.08-.7.08-.7 1.156.082 1.765 1.187 1.765 1.187 1.026 1.758 2.693 1.25 3.346.956.104-.744.402-1.25.732-1.538-2.555-.29-5.242-1.278-5.242-5.687 0-1.256.451-2.283 1.187-3.088-.12-.29-.515-1.459.113-3.042 0 0 .97-.31 3.18 1.18a11.046 11.046 0 0 1 2.897-.39c.984.004 1.976.133 2.896.39 2.208-1.49 3.177-1.18 3.177-1.18.63 1.583.235 2.752.115 3.042.74.805 1.183 1.832 1.183 3.088 0 4.42-2.69 5.393-5.254 5.676.413.354.78 1.055.78 2.129 0 1.537-.014 2.776-.014 3.153 0 .31.208.668.792.555C20.712 21.39 24 17.084 24 12c0-6.352-5.148-11.5-11.5-11.5z"/></svg>
            </a>
        </div>
    </div>
</nav>

<div class="container mx-auto p-6 grid grid-cols-12 gap-6">
    <div class="col-span-12 bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-4 flex items-center space-x-2">
            <span>Registro de Presença</span>
            @if($selected)
                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Turma {{ $groups->firstWhere('id',$selected)->name }}</span>
            @endif
        </h2>

        <!-- status alert / toast -->
        @if(session('status'))
            <div id="status-toast" class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded mb-4 alert">
                {{ session('status') }}
            </div>
        @endif

        <!-- filtro / combobox -->
        <form method="GET" class="mb-4">
            <div class="flex flex-wrap gap-4 items-end">
                <div class="relative">
                    <select name="group_id" class="block appearance-none w-full border border-gray-300 rounded-md py-2 pl-3 pr-8 focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Selecione a turma</option>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}" {{ $selected==$group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M5.516 7.548l4.484 4.482 4.483-4.482L16 8.553l-6 6-6-6z"/></svg>
                    </div>
                </div>
                <input type="date" name="date" value="{{ $date }}" class="border rounded-md p-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Carregar</button>
                @if($students)
                    <div class="ml-auto space-x-2">
                        <button type="button" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded">Limpar</button>
                        <button type="button" id="open-drawer" class="bg-blue-200 hover:bg-blue-300 text-blue-700 px-3 py-1 rounded">Ajuda</button>
                    </div>
                @endif
            </div>
        </form>

        @if($students)
            <!-- drawer (off-canvas) -->
            <div id="drawer" class="fixed inset-0 bg-black bg-opacity-50 hidden">
                <div class="absolute right-0 top-0 w-64 h-full bg-white shadow p-4">
                    <h3 class="font-semibold mb-2">Suporte</h3>
                    <p>Use o botão "Selecionar tudo" para marcar rapidamente todos os alunos.</p>
                    <button id="close-drawer" class="mt-4 text-sm text-blue-600">Fechar</button>
                </div>
            </div>

            <form method="POST">
                @csrf
                <input type="hidden" name="date" value="{{ $date }}">
                <input type="hidden" name="group_id" value="{{ $selected }}">
                <div class="mb-4">
                    <label class="block text-sm font-medium">Tópico da aula</label>
                    <input name="topic" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('topic') }}">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Material visto</label>
                    <textarea name="material" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('material') }}</textarea>
                </div>
                <div class="overflow-x-auto relative">
                    <table class="w-full table-auto divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-2 px-4">RM</th>
                                <th class="py-2 px-4">Nome</th>
                                <th class="py-2 px-4 text-center">
                                    <label class="inline-flex items-center"><input type="checkbox" id="select-all" class="mr-1">Sel. tudo</label>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $stu)
                                <tr class="odd:bg-white even:bg-gray-50 group" data-id="{{ $stu->id }}">
                                    <td class="py-2 px-4">{{ $stu->rm }}</td>
                                    <td class="py-2 px-4">
                                        <span class="flex items-center space-x-2 hover:bg-gray-100 p-1 rounded" title="Clique com o botão direito para opções">
                                            <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($stu->email ?? ''))) }}?s=24&d=identicon" alt="" class="rounded-full">
                                            <span class="hover:underline">{{ $stu->name }}</span>
                                        </span>
                                    </td>
                                    <td class="text-center"><input type="checkbox" name="present[{{ $stu->id }}]" value="1" class="present-checkbox" {{ isset($presences[$stu->id]) && $presences[$stu->id] ? 'checked' : '' }}></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- pagination mockup -->
                    <div class="mt-2 flex justify-end space-x-1 text-sm">
                        <button class="px-2 py-1 border rounded">&laquo;</button>
                        <span class="px-2 py-1 border rounded bg-blue-100">1</span>
                        <button class="px-2 py-1 border rounded">2</button>
                        <button class="px-2 py-1 border rounded">&raquo;</button>
                    </div>
                </div>
                <div class="mt-4 flex space-x-2">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">Salvar</button>
                    <button type="reset" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md">Reset</button>
                </div>
            </form>
        @endif
    </div>
</div>

<!-- context menu template -->
<div id="context-menu" class="fixed bg-white border rounded shadow-lg py-1 text-sm hidden">
    <a href="#" class="block px-4 py-1 hover:bg-gray-100">Ver perfil</a>
    <a href="#" class="block px-4 py-1 hover:bg-gray-100">Enviar mensagem</a>
</div>

<!-- simple scripts -->
<script>
    document.getElementById('select-all')?.addEventListener('change', function(e){
        document.querySelectorAll('.present-checkbox').forEach(cb=>cb.checked=e.target.checked);
    });
    document.getElementById('open-drawer')?.addEventListener('click',()=>document.getElementById('drawer').classList.remove('hidden'));
    document.getElementById('close-drawer')?.addEventListener('click',()=>document.getElementById('drawer').classList.add('hidden'));
    // context menu on name right-click
    document.querySelectorAll('tr.group').forEach(row=>{
        row.addEventListener('contextmenu',function(e){
            e.preventDefault();
            const menu=document.getElementById('context-menu');
            menu.style.top=e.clientY+'px';menu.style.left=e.clientX+'px';menu.classList.remove('hidden');
        });
    });
    document.addEventListener('click',()=>document.getElementById('context-menu').classList.add('hidden'));
    // auto-hide toast
    setTimeout(()=>document.getElementById('status-toast')?.remove(),5000);
</script>
@endsection

