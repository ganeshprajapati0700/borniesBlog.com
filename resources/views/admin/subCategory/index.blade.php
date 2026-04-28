@extends('admin.layouts.app')
@section('content')
    {{-- breadcrumb start here --}}
    <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Sub-Categories'],
        ]"></x-breadcrumb>
    {{-- breadcrumb end here --}}
    {{-- header start here --}}
    <x-page-header title="Sub-Categories Overview" subtitle="Manage and view all your blog sub-categories"
        buttonLabel="+ Add New Sub-Category" buttonUrl="{{ route('subcategories.create') }}" />
    @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 px-4 py-3 bg-red-100 border bg-red-400 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif
    {{-- header end here --}}
    {{-- search filters start here --}}
    <x-search-filter action="{{ route('subcategories.index') }}">
        <x-input-field label="Search Sub-Categories" name="search" placeholder="Search by name & slug..." />
        <x-select-field label="Category" name="categoryId" :options="['' => 'All Categories'] + $categories->pluck('name', 'id')->toArray()" />
        <x-select-field label="Status" name="status" :options="['' => 'All Status', '1' => 'Published', '0' => 'draft']" />
    </x-search-filter>
    {{-- search filters end here --}}
    {{-- table start here --}}
    <x-data-table :columns="['ID', 'Name', 'Slug', 'Category', 'Status', 'Actions']">
        @forelse ($subCategories as $subCategory)
            <tr class="hover:bg-slate-50 transition">
                <x-table-cell type="id">#{{ $subCategory->id }}</x-table-cell>
                <x-table-cell type="title">{{ $subCategory->name }}</x-table-cell>
                <x-table-cell type="slug">{{ $subCategory->slug }}</x-table-cell>
                <x-table-cell type="category">{{ $subCategory->category->name ?? '' }}</x-table-cell>
                <x-table-cell type="status">
                    @if ($subCategory->status == 1)
                        <x-status-badge :status="1" />
                    @else
                        <x-status-badge :status="0" />
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
    <div class="mt4">
        {{ $subCategories->links() }}
    </div>
    {{-- table end here --}}
@endsection