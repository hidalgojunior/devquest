@props(['messages'=>[], 'userId'])
<div class="border rounded-lg h-64 flex flex-col">
    <div class="flex-1 overflow-y-auto p-2 space-y-2">
        @foreach($messages as $msg)
            <div class="flex {{ $msg->sender_id==$userId?'justify-end':'' }}">
                <div class="max-w-xs px-3 py-2 rounded-lg {{ $msg->sender_id==$userId?'bg-blue-500 text-white':'bg-gray-200' }}">
                    {{ $msg->content }}
                    <div class="text-xs text-gray-500 mt-1">{{ $msg->created_at->format('H:i') }}</div>
                </div>
            </div>
        @endforeach
    </div>
    <form method="POST" class="p-2" action="{{ $action ?? '#' }}">
        @csrf
        <input type="text" name="content" class="w-full border rounded px-2 py-1" placeholder="Escreva...">
    </form>
</div>
