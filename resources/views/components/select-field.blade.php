@props(['label', 'name', 'options' => [], 'value' => null])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-slate-700 mb-2">
        {{ $label }}
    </label>
    <select name="{{ $name }}" id="{{ $name }}"
        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        @foreach ($options as $optValue => $optLabel)
            <option value="{{ $optValue }}" {{ $value == $optValue ? 'selected' : '' }}>
                {{ $optLabel }}
            </option>
        @endforeach
    </select>
</div>