@extends('admin.layouts.app')
@section('content')
    {{-- breadcrumb start here --}}
    <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Sub-Categories', 'url' => route('subcategories.index')],
            ['label' => 'Edit Sub-Category'],
        ]"></x-breadcrumb>
    {{-- breadcrumb end here --}}
    {{-- header start here --}}
    <x-page-header title="Edit Sub-Category" subtitle="Edit sub-category to organize your posts"
        buttonLabel="Back to Sub-Categories" buttonUrl="{{ route('subcategories.index') }}" />
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
        <form action="{{ route('subcategories.update', $subCategory->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')
            <x-input-field label="Sub-Category Name" name="name" placeholder="Enter sub-category name" required
                value="{{ $subCategory->name }}" />
            <x-select-field label="Category" name="category_id" :options="$categories->pluck('name', 'id')->toArray()"
                required value="{{ $subCategory->category_id }}" />
            <x-select-field label="Status" name="status" :options="['1' => 'Active', '0' => 'Inactive']" required
                value="{{ $subCategory->status }}" />
            <div>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition shadow-sm">
                    Update Sub Category
                </button>
            </div>
        </form>
    </div>
    {{-- form start here --}}
@endsection