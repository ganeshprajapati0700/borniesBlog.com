@props(['action', 'searchPlaceholder' => 'Search...'])

<div class="bg-white rounded-xl border border-slate-200 p-4 md:p-6 mb-6 shadow-sm">
    <form method="GET" action="{{ $action }}" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{ $slot }}
        </div>
        <div class="flex gap-2 justify-end">
            <a href="{{ $action }}" class="px-4 py-2 border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium rounded-lg transition">
                Reset
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                Apply Filters
            </button>
        </div>
    </form>
</div>
