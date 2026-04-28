@extends('admin.layouts.app')
@section('content')
    {{-- breadcrumb start here --}}
    <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Categories', 'url' => route('categories.index')],
            ['label' => 'Create Category'],
        ]"></x-breadcrumb>
    {{-- breadcrumb end here --}}
    {{-- header start here --}}
    <x-page-header title="Create New Category" subtitle="Add a new category to organize your posts"
        buttonLabel="Back to Categories" buttonUrl="{{ route('categories.index') }}" />
    {{-- @if (session('success'))
    <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
        {{ session('success') }}
    </div>
    @endif --}}
    @if ($errors->any())
        <div class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- header end here --}}
    {{-- form start here --}}
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
            @csrf
            <x-input-field label="Category Name" name="name" placeholder="Enter category name" required />
            {{-- <x-input-field label="Slug" name="slug" placeholder="Enter URL-friendly slug (optional)" /> --}}
            <x-select-field label="Status" name="status" :options="['1' => 'Active', '0' => 'Inactive']"
                value="{{ old('status', '1') }}" required />
            <div>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition shadow-sm">
                    Create Category
                </button>
            </div>
        </form>
    </div>
    {{-- form start here --}}
@endsection