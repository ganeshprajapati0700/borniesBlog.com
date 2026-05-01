@extends('admin.layouts.app')
@section('page-title', 'Tags')
@section('content')
    <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Tags']]" />
    <x-page-header title="Tags Overview" subtitle="Manage and view all your blog tags" buttonLabel="+ Add New Tag"
        buttonUrl="{{ route('tags.create') }}" />

    @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded">{{ session('error') }}</div>
    @endif

    <x-search-filter action="{{ route('tags.index') }}">
        <x-input-field label="Search tags" name="search" placeholder="Search by name..." />
        <x-select-field label="Status" name="status" :options="['' => 'All Status', '1' => 'Active', '0' => 'Inactive']" />
    </x-search-filter>

    {{-- Count bar --}}
    <div class="flex items-center justify-between mb-3 text-sm text-slate-500">
        <span>
            Showing <strong class="text-slate-700">{{ $data->count() }}</strong> of
            <strong class="text-slate-700">{{ $data->total() }}</strong> tags
            @if (request()->hasAny(['search', 'status']) && array_filter(request()->only(['search', 'status'])))
                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold bg-indigo-50 text-indigo-600 border border-indigo-200">Filtered</span>
            @endif
        </span>
    </div>

    <x-data-table :columns="['ID', 'Name', 'Slug', 'Status', 'Actions']">
        @forelse ($data as $tag)
            <tr class="hover:bg-slate-50 transition">
                <x-table-cell type="id">#{{ $tag->id }}</x-table-cell>
                <x-table-cell type="title">{{ $tag->name }}</x-table-cell>
                <x-table-cell type="slug">{{ $tag->slug }}</x-table-cell>
                <x-table-cell type="status">
                    @if (auth()->user()->is_admin)
                        <button
                            data-url="{{ route('tags.toggle-status', $tag->id) }}"
                            data-status="{{ $tag->status }}"
                            onclick="toggleStatus(this)"
                            class="status-toggle-btn inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold border cursor-pointer transition-all duration-200 {{ $tag->status == 1 ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-amber-50 text-amber-700 border-amber-200' }}">
                            <span class="w-1.5 h-1.5 rounded-full inline-block {{ $tag->status == 1 ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                            <span class="label">{{ $tag->status == 1 ? 'Active' : 'Inactive' }}</span>
                        </button>
                    @else
                        <x-status-badge :status="(int)$tag->status" />
                    @endif
                </x-table-cell>
                <x-table-cell type="action">
                    <x-action-buttons editUrl="{{ route('tags.edit', $tag->id) }}"
                        deleteUrl="{{ route('tags.destroy', $tag->id) }}" :itemId="$tag->id" />
                </x-table-cell>
            </tr>
        @empty
            <x-empty-state colspan="5" message="No tags found" submessage="Try adjusting your search filters" />
        @endforelse
    </x-data-table>

    <div class="mt-4 flex items-center justify-between text-sm text-slate-600">
        <span class="text-xs text-slate-400">Page {{ $data->currentPage() }} of {{ $data->lastPage() }}</span>
        <div>{{ $data->links() }}</div>
    </div>

    @include('admin.partials.status-toggle-script')
@endsection