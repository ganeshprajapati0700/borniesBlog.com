@extends('admin.layouts.app')
@section('content')
    {{-- breadcrumb start here --}}
    <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Categories']]" />
    {{-- breadcrumb end here --}}
    {{-- header start here --}}
    <x-page-header title="Categories Overview" subtitle="Manage and view all your blog categories"
        buttonLabel="+ Add New Category" buttonUrl="{{ route('categories.create') }}" />
    @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif
    {{-- header end here --}}
    {{-- search filters start here --}}
    <x-search-filter action="{{ route('categories.index') }}">
        <x-input-field label="Search Categories" name="search" placeholder="Search by name..." />
        <x-select-field label="Status" name="status" :options="['' => 'All Status', '1' => 'Published', '0' => 'Draft']" />
    </x-search-filter>
    {{-- table start here --}}
    <x-data-table :columns="['ID', 'Name', 'Slug', 'Status', 'Actions']">
        @forelse ($categories as $category)
            <tr class="hover:bg-slate-50 transition">
                <x-table-cell type="id">#{{ $category->id }}</x-table-cell>
                <x-table-cell type="title">{{ $category->name }}</x-table-cell>
                <x-table-cell type="slug">{{ $category->slug }}</x-table-cell>
                <x-table-cell type="status">
                    <x-status-badge :status="$category->status === 1 ? 'Active' : 'Inactive'" />
                </x-table-cell>
                <x-table-cell type="action">
                    <x-action-buttons editUrl="{{ route('categories.edit', $category->id) }}"
                        deleteUrl="{{ route('categories.destroy', $category->id) }}" :itemId="$category->id" />
                </x-table-cell>
            </tr>
        @empty
            <x-empty-state colspan="5" message="No categories found" submessage="Try adjusting your search filters" />
        @endforelse
    </x-data-table>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
    {{-- table end here --}}
@endsection