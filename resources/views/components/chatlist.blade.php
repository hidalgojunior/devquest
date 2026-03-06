@props(['conversations'=>[]])
<div class="divide-y">
    @foreach($conversations as $conv)
        <a href="{{ $conv['url'] }}" class="block px-4 py-2 hover:bg-gray-100 flex items-center">
            <span class="flex-1">{{ $conv['name'] }}</span>
            <span class="text-xs text-gray-500">{{ $conv['unread'] ?? '' }}</span>
        </a>
    @endforeach
</div>
