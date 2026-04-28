@extends('admin.layouts.app')
@section('content')
    {{-- breadcrumb start here --}}
    <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Posts']]" />
    {{-- breadcrumb end here --}}

    {{-- header start here --}}
    <x-page-header title="Posts Overview" subtitle="Manage and view all your blog posts" buttonLabel="+ Add New Post"
        buttonUrl="{{ route('posts.create') }}" />
    {{-- header end here --}}

    {{-- search filters start here --}}
    <x-search-filter action="{{ route('posts.index') }}">
        <x-input-field label="Search Posts" name="search" placeholder="Search by title..." />

        <x-select-field label="Category" name="category" :options="['' => 'All Categories'] + $categories->pluck('name', 'id')->toArray()" />

        <x-select-field label="Status" name="status" :options="['' => 'All Status', 'published' => 'Published', 'draft' => 'Draft']" />
    </x-search-filter>
    {{-- search filters end here --}}

    {{-- table start here --}}
    <x-data-table :columns="['ID', 'Title', 'Author', 'Date', 'Status', 'Actions']">
        @forelse($posts as $post)
            <tr class="hover:bg-slate-50 transition-colors duration-200 border-b border-slate-100">
                <x-table-cell type="id">#{{ $post->id }}</x-table-cell>

                <x-table-cell type="title-with-subtitle">
                    <div class="max-w-xs">
                        <p class="text-sm font-semibold text-slate-800 mb-1 truncate">{{ $post->title }}</p>
                        <p class="text-xs text-slate-500 line-clamp-2">{{ Str::limit($post->description ?? 'No description available', 80) }}</p>
                        @if($post->category)
                            <span class="inline-flex items-center mt-1 px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-700">
                                {{ $post->category->name }}
                            </span>
                        @endif
                    </div>
                </x-table-cell>

                <x-table-cell type="author">{{ $post->user?->name ?? 'Unknown Author' }}</x-table-cell>

                <x-table-cell type="date">
                    <div class="flex flex-col">
                        <span class="font-medium">{{ $post->created_at->format('M j, Y') }}</span>
                        <span class="text-xs text-slate-500">{{ $post->created_at->format('g:i A') }}</span>
                    </div>
                </x-table-cell>

                <x-table-cell type="status">
                    <x-status-badge :status="($post->status ?? '') === 'published' ? 'Active' : 'Inactive'" />
                </x-table-cell>

                <x-table-cell type="center">
                    <x-action-buttons
                        viewUrl="{{ route('posts.show', $post->id) }}"
                        editUrl="{{ route('posts.edit', $post->id) }}"
                        deleteUrl="{{ route('posts.destroy', $post->id) }}"
                        :itemId="$post->id"
                    />
                </x-table-cell>
            </tr>
        @empty
            <x-empty-state colspan="6" message="No posts found" submessage="Try adjusting your search filters or create your first post" />
        @endforelse
    </x-data-table>
    {{-- table end here --}}

    {{-- pagination start here --}}
    <div class="mt-6">
        {{ $posts->links() }}
    </div>
    {{-- pagination end here --}}
@endsection
