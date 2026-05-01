@extends('admin.layouts.app')
@section('page-title', 'Posts')
@section('content')
    {{-- Breadcrumb --}}
    <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Posts']]" />

    {{-- Header --}}
    <x-page-header title="Posts Overview" subtitle="Manage and view all your blog posts" buttonLabel="+ Add New Post"
        buttonUrl="{{ route('posts.create') }}" />

    @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Filters --}}
    <x-search-filter action="{{ route('posts.index') }}">
        <x-input-field label="Search Posts" name="search" placeholder="Search by title..." />
        <x-select-field label="Category" name="category" :options="['' => 'All Categories'] + $categories->pluck('name', 'id')->toArray()" />
        <x-select-field label="Author" name="author" :options="['' => 'All Authors'] + $authors->pluck('name', 'id')->toArray()" />
        <x-select-field label="Status" name="status" :options="['' => 'All Status', '1' => 'Published', '0' => 'Draft']" />
    </x-search-filter>

    {{-- Count bar --}}
    <div class="flex items-center justify-between mb-3 text-sm text-slate-500">
        <span>
            Showing <strong class="text-slate-700">{{ $posts->count() }}</strong> of
            <strong class="text-slate-700">{{ $posts->total() }}</strong> posts
            @if (request()->hasAny(['search', 'category', 'author', 'status']) && array_filter(request()->only(['search', 'category', 'author', 'status'])))
                <span
                    class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold bg-indigo-50 text-indigo-600 border border-indigo-200">Filtered</span>
            @endif
        </span>
    </div>

    {{-- Table --}}
    <div class="relative">
        <x-data-table :columns="['Select', 'ID', 'Title', 'Author', 'Date', 'Status', 'Actions']">
            @forelse($posts as $post)
                <tr class="hover:bg-slate-50 transition-colors duration-200 border-b border-slate-100"
                    data-row-id="{{ $post->id }}">
                    <x-table-cell type="checkbox" :value="$post->id" />

                    <x-table-cell type="id">#{{ $post->id }}</x-table-cell>

                    <x-table-cell type="title-with-subtitle">
                        <div class="max-w-xs group cursor-pointer" onclick="enableQuickEdit(this, '{{ $post->id }}', 'title')">
                            <p
                                class="text-sm font-semibold text-slate-800 mb-1 truncate group-hover:text-indigo-600 transition-colors flex items-center gap-2">
                                <span class="title-text">{{ $post->title }}</span>
                                <svg class="w-3 h-3 text-slate-400 opacity-0 group-hover:opacity-100 transition-opacity"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                </svg>
                            </p>
                            <p class="text-xs text-slate-500 line-clamp-2">
                                {{ Str::limit($post->shortDesc ?? 'No description available', 80) }}
                            </p>
                            @if ($post->category)
                                <span
                                    class="inline-flex items-center mt-1 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-slate-100 text-slate-600">
                                    {{ $post->category->name }}
                                </span>
                            @endif
                        </div>
                    </x-table-cell>

                    <x-table-cell type="author">{{ $post->author?->name ?? 'Unknown Author' }}</x-table-cell>

                    <x-table-cell type="date">
                        <div class="flex flex-col">
                            <span class="font-medium text-slate-700">{{ $post->created_at->format('M j, Y') }}</span>
                            <span class="text-[11px] text-slate-400">{{ $post->created_at->format('g:i A') }}</span>
                        </div>
                    </x-table-cell>

                    {{-- Status toggle — author or admin only --}}
                    <x-table-cell type="status">
                        @can('toggleStatus', $post)
                            <button data-id="{{ $post->id }}" data-url="{{ route('posts.toggle-status', $post->id) }}"
                                data-status="{{ $post->status }}" onclick="toggleStatus(this)"
                                class="status-toggle-btn inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider border cursor-pointer transition-all duration-200 {{ $post->status == 1 ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-amber-50 text-amber-700 border-amber-200' }}">
                                <span
                                    class="w-1.5 h-1.5 rounded-full inline-block {{ $post->status == 1 ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                <span class="label">{{ $post->status == 1 ? 'Published' : 'Draft' }}</span>
                            </button>
                        @else
                            {{-- Read-only badge for non-owners --}}
                            <span
                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider border {{ $post->status == 1 ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-amber-50 text-amber-700 border-amber-200' }}">
                                <span
                                    class="w-1.5 h-1.5 rounded-full inline-block {{ $post->status == 1 ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                {{ $post->status == 1 ? 'Published' : 'Draft' }}
                            </span>
                        @endcan
                    </x-table-cell>

                    {{-- Action buttons — conditionally shown based on ownership --}}
                    <x-table-cell type="center">
                        <div class="flex items-center justify-center gap-2">
                            @can('update', $post)
                                <a href="{{ route('posts.edit', $post->id) }}"
                                    class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 hover:bg-indigo-100 transition-colors duration-150"
                                    title="Edit Post">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                            @endcan

                            @can('delete', $post)
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this post?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 text-red-500 hover:bg-red-100 transition-colors duration-150"
                                        title="Delete Post">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            @endcan
                            @if (!auth()->user()->can('update', $post) && !auth()->user()->can('delete', $post))
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">Protected</span>
                            @endif

                        </div>
                    </x-table-cell>
                </tr>
            @empty
                <x-empty-state colspan="7" message="No posts found"
                    submessage="Try adjusting your search filters or create your first post" />
            @endforelse
        </x-data-table>

        {{-- Bulk Action Floating Bar --}}
        <div id="bulk-action-bar"
            class="fixed bottom-8 left-1/2 -translate-x-1/2 bg-slate-900 text-white px-6 py-3 rounded-2xl shadow-2xl flex items-center gap-6 border border-white/10 opacity-0 pointer-events-none translate-y-10 transition-all duration-300 z-50">
            <div class="flex items-center gap-2 pr-6 border-r border-white/20">
                <span id="selected-count"
                    class="bg-indigo-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold">0</span>
                <span class="text-sm font-medium text-slate-300">Selected</span>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="handleBulkAction('publish')"
                    class="flex items-center gap-2 hover:text-emerald-400 transition-colors text-sm font-semibold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    </svg>
                    Publish
                </button>
                <button onclick="handleBulkAction('draft')"
                    class="flex items-center gap-2 hover:text-amber-400 transition-colors text-sm font-semibold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 8v4l3 3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    </svg>
                    Draft
                </button>
                <button onclick="handleBulkAction('delete')"
                    class="flex items-center gap-2 hover:text-red-400 transition-colors text-sm font-semibold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    </svg>
                    Delete
                </button>
            </div>
            <button onclick="clearSelection()" class="ml-4 p-1 hover:bg-white/10 rounded-lg transition-colors">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-4 flex items-center justify-between text-sm text-slate-600">
        <span class="text-xs text-slate-400">Page {{ $posts->currentPage() }} of {{ $posts->lastPage() }}</span>
        <div>{{ $posts->links() }}</div>
    </div>

    @include('admin.partials.status-toggle-script')

    @push('scripts')
        <script>
            // Multiple Selection Logic
            const selectAll = document.getElementById('select-all');
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');
            const bulkActionBar = document.getElementById('bulk-action-bar');
            const selectedCountSpan = document.getElementById('selected-count');

            function updateBulkBar() {
                const checked = document.querySelectorAll('.row-checkbox:checked');
                selectedCountSpan.textContent = checked.length;

                if (checked.length > 0) {
                    bulkActionBar.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-10');
                } else {
                    bulkActionBar.classList.add('opacity-0', 'pointer-events-none', 'translate-y-10');
                    selectAll.checked = false;
                }
            }

            selectAll.addEventListener('change', () => {
                rowCheckboxes.forEach(cb => cb.checked = selectAll.checked);
                updateBulkBar();
            });

            rowCheckboxes.forEach(cb => {
                cb.addEventListener('change', () => {
                    updateBulkBar();
                    if (!cb.checked) selectAll.checked = false;
                    else if (document.querySelectorAll('.row-checkbox:checked').length === rowCheckboxes.length) selectAll.checked = true;
                });
            });

            function clearSelection() {
                rowCheckboxes.forEach(cb => cb.checked = false);
                selectAll.checked = false;
                updateBulkBar();
            }

            function handleBulkAction(action) {
                const ids = Array.from(document.querySelectorAll('.row-checkbox:checked')).map(cb => cb.value);
                if (ids.length === 0) return;

                if (action === 'delete' && !confirm('Are you sure you want to delete the selected posts?')) return;

                fetch('{{ route("posts.bulk-action") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ action, ids })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert(data.message);
                        }
                    });
            }

            // Quick Edit Logic
            function enableQuickEdit(container, id, field) {
                if (container.querySelector('input')) return;

                const textSpan = container.querySelector('.title-text');
                const originalValue = textSpan.textContent.trim();

                const input = document.createElement('input');
                input.type = 'text';
                input.value = originalValue;
                input.className = 'w-full px-2 py-1 text-sm border border-indigo-300 rounded focus:ring-1 focus:ring-indigo-500 focus:outline-none bg-white';

                textSpan.style.display = 'none';
                container.querySelector('p').appendChild(input);
                input.focus();

                input.onblur = () => finishQuickEdit(input, container, id, field, originalValue);
                input.onkeydown = (e) => {
                    if (e.key === 'Enter') input.blur();
                    if (e.key === 'Escape') {
                        input.value = originalValue;
                        input.blur();
                    }
                };
            }

            function finishQuickEdit(input, container, id, field, originalValue) {
                const newValue = input.value.trim();
                const textSpan = container.querySelector('.title-text');

                if (newValue === originalValue || newValue === '') {
                    input.remove();
                    textSpan.style.display = 'inline';
                    return;
                }

                fetch(`/admin/posts/${id}/quick-update`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ [field]: newValue })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            textSpan.textContent = newValue;
                        } else {
                            alert(data.message);
                        }
                        input.remove();
                        textSpan.style.display = 'inline';
                    });
            }
        </script>
    @endpush
@endsection