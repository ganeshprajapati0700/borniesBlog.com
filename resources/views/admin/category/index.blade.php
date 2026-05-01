@extends('admin.layouts.app')
@section('page-title', 'Categories')
@section('content')
    <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Categories']]" />
    <x-page-header title="Categories Overview" subtitle="Manage and view all your blog categories"
        buttonLabel="+ Add New Category" buttonUrl="{{ route('categories.create') }}" />

    @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded">{{ session('error') }}</div>
    @endif

    <x-search-filter action="{{ route('categories.index') }}">
        <x-input-field label="Search Categories" name="search" placeholder="Search by name..." />
        <x-select-field label="Status" name="status" :options="['' => 'All Status', '1' => 'Active', '0' => 'Inactive']" />
    </x-search-filter>

    {{-- Count bar --}}
    <div class="flex items-center justify-between mb-3 text-sm text-slate-500">
        <span>
            Showing <strong class="text-slate-700">{{ $categories->count() }}</strong> of
            <strong class="text-slate-700">{{ $categories->total() }}</strong> categories
            @if (request()->hasAny(['search', 'status']) && array_filter(request()->only(['search', 'status'])))
                <span
                    class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold bg-indigo-50 text-indigo-600 border border-indigo-200">Filtered</span>
            @endif
        </span>
    </div>

    <div class="relative">
        <x-data-table :columns="['Select', 'ID', 'Name', 'Slug', 'Status', 'Actions']">
            @forelse ($categories as $category)
                <tr class="hover:bg-slate-50 transition border-b border-slate-100" data-row-id="{{ $category->id }}">
                    <x-table-cell type="checkbox" :value="$category->id" />
                    <x-table-cell type="id">#{{ $category->id }}</x-table-cell>
                    <x-table-cell type="title">
                        <div class="group cursor-pointer flex items-center gap-2"
                            onclick="enableQuickEdit(this, '{{ $category->id }}', 'name')">
                            <span class="title-text">{{ $category->name }}</span>
                            <svg class="w-3 h-3 text-slate-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                            </svg>
                        </div>
                    </x-table-cell>
                    <x-table-cell type="slug">{{ $category->slug }}</x-table-cell>
                    <x-table-cell type="status">
                        @if (auth()->user()->is_admin)
                            <button data-url="{{ route('categories.toggle-status', $category->id) }}"
                                data-status="{{ $category->status }}" onclick="toggleStatus(this)"
                                class="status-toggle-btn inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider border cursor-pointer transition-all duration-200 {{ $category->status == 1 ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-amber-50 text-amber-700 border-amber-200' }}">
                                <span
                                    class="w-1.5 h-1.5 rounded-full inline-block {{ $category->status == 1 ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                <span class="label">{{ $category->status == 1 ? 'Active' : 'Inactive' }}</span>
                            </button>
                        @else
                            <x-status-badge :status="(int) $category->status" />
                        @endif
                    </x-table-cell>
                    <x-table-cell type="action">
                        <x-action-buttons editUrl="{{ route('categories.edit', $category->id) }}"
                            deleteUrl="{{ route('categories.destroy', $category->id) }}" :itemId="$category->id" />
                    </x-table-cell>
                </tr>
            @empty
                <x-empty-state colspan="6" message="No categories found" submessage="Try adjusting your search filters" />
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
                    Activate
                </button>
                <button onclick="handleBulkAction('draft')"
                    class="flex items-center gap-2 hover:text-amber-400 transition-colors text-sm font-semibold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 8v4l3 3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    </svg>
                    Deactivate
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

    <div class="mt-4 flex items-center justify-between text-sm text-slate-600">
        <span class="text-xs text-slate-400">Page {{ $categories->currentPage() }} of {{ $categories->lastPage() }}</span>
        <div>{{ $categories->links() }}</div>
    </div>

    @include('admin.partials.status-toggle-script')

    @push('scripts')
        <script>
            const selectAll = document.getElementById('select-all');
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');
            const bulkActionBar = document.getElementById('bulk-action-bar');
            const selectedCountSpan = document.getElementById('selected-count');

            function updateBulkBar() {
                const checked = document.querySelectorAll('.row-checkbox:checked');
                selectedCountSpan.textContent = checked.length;
                if (checked.length > 0) bulkActionBar.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-10');
                else {
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
                if (action === 'delete' && !confirm('Are you sure you want to delete the selected categories?')) return;

                fetch('{{ route("categories.bulk-action") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ action, ids })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) location.reload();
                        else alert(data.message);
                    });
            }

            function enableQuickEdit(container, id, field) {
                if (container.querySelector('input')) return;
                const textSpan = container.querySelector('.title-text');
                const originalValue = textSpan.textContent.trim();
                const input = document.createElement('input');
                input.type = 'text';
                input.value = originalValue;
                input.className = 'w-full px-2 py-1 text-sm border border-indigo-300 rounded focus:ring-1 focus:ring-indigo-500 outline-none';
                textSpan.style.display = 'none';
                container.appendChild(input);
                input.focus();
                input.onblur = () => finishQuickEdit(input, container, id, field, originalValue);
                input.onkeydown = (e) => { if (e.key === 'Enter') input.blur(); if (e.key === 'Escape') { input.value = originalValue; input.blur(); } };
            }

            function finishQuickEdit(input, container, id, field, originalValue) {
                const newValue = input.value.trim();
                const textSpan = container.querySelector('.title-text');
                if (newValue === originalValue || newValue === '') { input.remove(); textSpan.style.display = 'inline'; return; }
                fetch(`/admin/categories/${id}/quick-update`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ [field]: newValue })
                }).then(res => res.json()).then(data => {
                    if (data.success) textSpan.textContent = newValue;
                    else alert(data.message);
                    input.remove(); textSpan.style.display = 'inline';
                });
            }
        </script>
    @endpush
@endsection