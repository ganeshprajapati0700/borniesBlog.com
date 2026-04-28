@props(['status'])

@php
    $statusConfig = [
        'Active' => [
            'bg' => 'bg-emerald-50 border-emerald-200',
            'text' => 'text-emerald-700',
            'dot' => 'bg-emerald-500',
            'label' => 'Active'
        ],
        'Inactive' => [
            'bg' => 'bg-red-50 border-red-200',
            'text' => 'text-red-700',
            'dot' => 'bg-red-500',
            'label' => 'Inactive'
        ]
    ];
    $statusText = $status == 1 ? 'Active' : 'Inactive';

    $config = $statusConfig[$statusText] ?? $statusConfig['Inactive'];
@endphp

<span
    class="inline-flex items-center gap-2 px-2 py-1 rounded-full text-xs font-semibold border {{ $config['bg'] }} {{ $config['text'] }}">
    <span class="w-2 h-2 rounded-full {{ $config['dot'] }}"></span>
    {{ $config['label'] }}
</span>