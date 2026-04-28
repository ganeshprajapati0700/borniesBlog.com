@props(['type' => 'text'])

@switch($type)
    @case('id')
        <td class="px-4 md:px-6 py-4 text-sm text-slate-600">
            <span class="font-mono text-xs bg-slate-100 text-slate-700 px-2 py-1 rounded-md font-medium">{{ $slot }}</span>
        </td>
        @break

    @case('title')
        <td class="px-4 md:px-6 py-4">
            <div class="max-w-xs">
                <p class="text-sm font-semibold text-slate-800 truncate">{{ $slot }}</p>
            </div>
        </td>
        @break

    @case('title-with-subtitle')
        <td class="px-4 md:px-6 py-4">
            {{ $slot }}
        </td>
        @break

    @case('author')
        <td class="px-4 md:px-6 py-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white text-xs font-semibold">
                    {{ substr($slot, 0, 1) }}
                </div>
                <span class="text-sm font-medium text-slate-700">{{ $slot }}</span>
            </div>
        </td>
        @break

    @case('date')
        <td class="px-4 md:px-6 py-4 text-sm text-slate-600">
            <div class="flex flex-col">
                <span class="font-medium">{{ $slot }}</span>
            </div>
        </td>
        @break

    @case('status')
        <td class="px-4 md:px-6 py-4">
            {{ $slot }}
        </td>
        @break

    @case('action')
        <td class="px-4 md:px-6 py-4">
            {{ $slot }}
        </td>
        @break

    @default
        <td class="px-4 md:px-6 py-4 text-sm text-slate-600">
            {{ $slot }}
        </td>
@endswitch
