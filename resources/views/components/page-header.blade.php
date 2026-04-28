@props(['title', 'subtitle' => null, 'buttonLabel' => null, 'buttonUrl' => null])

<div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8 gap-4">
    <div>
        <h3 class="text-2xl md:text-3xl font-bold text-slate-800 tracking-tight drop-shadow-sm">
            {{ $title }}
        </h3>
        @if($subtitle)
            <p class="text-slate-500 text-sm mt-1">{{ $subtitle }}</p>
        @endif
    </div>
    @if($buttonLabel && $buttonUrl)
        <a href="{{ $buttonUrl }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition shadow-sm">
            {{ $buttonLabel }}
        </a>
    @endif
</div>
