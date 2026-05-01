@extends('admin.layouts.app')
@section('page-title', 'Sub-Categories')
@section('content')
    <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Sub-Categories']]"></x-breadcrumb>
    <x-page-header title="Sub-Categories Overview" subtitle="Manage and view all your blog sub-categories"
        buttonLabel="+ Add New Sub-Category" buttonUrl="{{ route('subcategories.create') }}" />

    @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-4 px-4 py-3 bg-red-100 border bg-red-400 text-red-700 rounded">{{ session('error') }}</div>
    @endif

    <x-search-filter action="{{ route('subcategories.index') }}">
        <x-input-field label="Search Sub-Categories" name="search" placeholder="Search by name & slug..." />
        <x-select-field label="Category" name="categoryId" :options="['' => 'All Categories'] + $categories->pluck('name', 'id')->toArray()" />
        <x-select-field label="Status" name="status" :options="['' => 'All Status', '1' => 'Active', '0' => 'Inactive']" />
    </x-search-filter>

    {{-- Count bar --}}
    <div class="flex items-center justify-between mb-3 text-sm text-slate-500">
        <span>
            Showing <strong class="text-slate-700">{{ $subCategories->count() }}</strong> of
            <strong class="text-slate-700">{{ $subCategories->total() }}</strong> sub-categories
            @if (request()->hasAny(['search', 'categoryId', 'status']) && array_filter(request()->only(['search', 'categoryId', 'status'])))
                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold bg-indigo-50 text-indigo-600 border border-indigo-200">Filtered</span>
            @endif
        </span>
    </div>

    <x-data-table :columns="['ID', 'Name', 'Slug', 'Category', 'Status', 'Actions']">
        @forelse ($subCategories as $subCategory)
            <tr class="hover:bg-slate-50 transition">
                <x-table-cell type="id">#{{ $subCategory->id }}</x-table-cell>
                <x-table-cell type="title">{{ $subCategory->name }}</x-table-cell>
                <x-table-cell type="slug">{{ $subCategory->slug }}</x-table-cell>
                <x-table-cell type="category">{{ $subCategory->category->name ?? '' }}</x-table-cell>
                <x-table-cell type="status">
                    @if (auth()->user()->is_admin)
                        <button
                            data-url="{{ route('subcategories.toggle-status', $subCategory->id) }}"
                            data-status="{{ $subCategory->status }}"
                            onclick="toggleStatus(this)"
                            class="status-toggle-btn inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold border cursor-pointer transition-all duration-200 {{ $subCategory->status == 1 ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-amber-50 text-amber-700 border-amber-200' }}">
                            <span class="w-1.5 h-1.5 rounded-full inline-block {{ $subCategory->status == 1 ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                            <span class="label">{{ $subCategory->status == 1 ? 'Active' : 'Inactive' }}</span>
                        </button>
                    @else
                        <x-status-badge :status="(int)$subCategory->status" />
                    @endif
                </x-table-cell>
                <x-table-cell type="action">
                    <x-action-buttons editUrl="{{ route('subcategories.edit', $subCategory->id) }}"
                        deleteUrl="{{ route('subcategories.destroy', $subCategory->id) }}" :itemId="$subCategory->id" />
                </x-table-cell>
            </tr>
        @empty
            <x-empty-state colspan="6" message="No Sub-Categories found" submessage="Try adjusting your search filters" />
        @endforelse
    </x-data-table>

    <div class="mt-4 flex items-center justify-between text-sm text-slate-600">
        <span class="text-xs text-slate-400">Page {{ $subCategories->currentPage() }} of {{ $subCategories->lastPage() }}</span>
        <div>{{ $subCategories->links() }}</div>
    </div>

    @include('admin.partials.status-toggle-script')
@endsection