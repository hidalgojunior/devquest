@props(['label','type'=>'text','name','value'=>'','options'=>[]])
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ $label }}</label>
    @php $error = $errors->first($name); @endphp
    @if($type=='textarea')
        <textarea name="{{ $name }}" {{ $attributes->merge(['class'=>'mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md'.($error?' border-red-500':'')]) }}>{{ $value }}</textarea>
    @elseif($type=='select')
        <select name="{{ $name }}" {{ $attributes->merge(['class'=>'mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md'.($error?' border-red-500':'')]) }}>
            @foreach($options as $val=>$text)
                <option value="{{ $val }}" {{ $val==$value?'selected':'' }}>{{ $text }}</option>
            @endforeach
        </select>
    @elseif($type=='file')
        <input type="file" name="{{ $name }}" {{ $attributes->merge(['class'=>'mt-1 block w-full']) }}>
    @else
        <input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" {{ $attributes->merge(['class'=>'mt-1 block w-full border-gray-300 dark:border-gray-600 rounded-md'.($error?' border-red-500':'')]) }}>
    @endif
    @if($error)
        <p class="text-xs text-red-600 mt-1">{{ $error }}</p>
    @endif
</div>
