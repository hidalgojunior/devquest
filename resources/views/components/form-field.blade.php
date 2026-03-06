@props(['label','type'=>'text','name','value'=>'','options'=>[]])
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    @if($type=='textarea')
        <textarea name="{{ $name }}" {{ $attributes->merge(['class'=>'mt-1 block w-full border-gray-300 rounded-md']) }}>{{ $value }}</textarea>
    @elseif($type=='select')
        <select name="{{ $name }}" {{ $attributes->merge(['class'=>'mt-1 block w-full border-gray-300 rounded-md']) }}>
            @foreach($options as $val=>$text)
                <option value="{{ $val }}" {{ $val==$value?'selected':'' }}>{{ $text }}</option>
            @endforeach
        </select>
    @elseif($type=='file')
        <input type="file" name="{{ $name }}" {{ $attributes->merge(['class'=>'mt-1 block w-full']) }}>
    @else
        <input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" {{ $attributes->merge(['class'=>'mt-1 block w-full border-gray-300 rounded-md']) }}>
    @endif
</div>
