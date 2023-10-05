@props(['disabled' => false, 'label', 'require' => false, 'messages'])
<div>
    <label {{ $attributes->merge(['class' => 'text-gray-900']) }}>
        {{ $label ?? $slot }}: 
        @if($require)
        <span style="color: red">*</span>
        @endif
    </label>
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-input border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>

    @if ($messages)
        <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1 mt-2']) }}>
            @foreach ((array) $messages as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    @endif
</div>