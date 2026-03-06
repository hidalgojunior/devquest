@props(['id','title'])
<div id="{{ $id }}" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
        <div class="px-4 py-2 border-b">
            <h3 class="text-lg font-semibold">{{ $title }}</h3>
        </div>
        <div class="p-4">
            {{ $slot }}
        </div>
        <div class="px-4 py-2 border-t text-right">
            <button onclick="document.getElementById('{{ $id }}').classList.add('hidden')" class="px-4 py-2 bg-gray-300 rounded">Fechar</button>
        </div>
    </div>
</div>
