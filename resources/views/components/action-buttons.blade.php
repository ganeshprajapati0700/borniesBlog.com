@props(['viewUrl' => null, 'editUrl' => null, 'deleteUrl' => null, 'itemId' => null])

<div class="flex items-center gap-1">
    @if($viewUrl)
        <a href="{{ $viewUrl }}"
            class="group relative p-2 hover:bg-blue-50 rounded-lg text-blue-600 hover:text-blue-700 transition-all duration-200"
            title="View Details">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                </path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                </path>
            </svg>
            <span
                class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-slate-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">View</span>
        </a>
    @endif

    @if($editUrl)
        <a href="{{ $editUrl }}"
            class="group relative p-2 hover:bg-indigo-50 rounded-lg text-indigo-600 hover:text-indigo-700 transition-all duration-200"
            title="Edit">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                </path>
            </svg>
            <span
                class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-slate-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">Edit</span>
        </a>
    @endif

    @if($deleteUrl && $itemId)
        <button
            onclick="if(confirm('Are you sure you want to delete this item? This action cannot be undone.')) { document.getElementById('delete-form-{{ $itemId }}').submit(); }"
            class="group relative p-2 hover:bg-red-50 rounded-lg text-red-600 hover:text-red-700 transition-all duration-200"
            title="Delete">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                </path>
            </svg>
            <span
                class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-slate-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">Delete</span>
        </button>
        <form id="delete-form-{{ $itemId }}" action="{{ $deleteUrl }}" method="POST" style="display:none;">
            @csrf
            @method('DELETE')
        </form>
    @endif
</div>