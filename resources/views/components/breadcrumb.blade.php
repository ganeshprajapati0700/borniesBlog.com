@props(['items' => []])

<div class="mb-6 flex items-center gap-2 text-sm">
    @foreach($items as $index => $item)
        @if($index > 0)
            <span class="text-slate-400">/</span>
        @endif
        
        @if(isset($item['url']))
            <a href="{{ $item['url'] }}" class="text-blue-600 hover:text-blue-800 hover:underline transition">
                {{ $item['label'] }}
            </a>
        @else
            <span class="text-slate-600 font-medium">{{ $item['label'] }}</span>
        @endif
    @endforeach
</div>
