@extends('admin.layouts.app')
@section('content')
    {{-- --}}
    <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Sub-Categories', 'url' => route('subcategories.index')],
            ['label' => 'Create Sub-Category'],
        ]"></x-breadcrumb>
    {{-- header start here --}}
    <x-page-header title="Create Sub-Category" subtitle="Add a new sub-category to the blog" buttonLabel="Back"
        buttonUrl="{{ route('subcategories.index') }}" buttonIcon="fa fa-arrow-left" />
    {{-- header end here --}}
    {{-- form start here --}}
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('subcategories.store') }}" method="POST" class="space-y-6">
            @csrf
            <x-input-field label="Sub-Category Name" name="name" placeholder="Enter sub-category name" required />
            <x-select-field label="Category Name" name="category_id" :options="['' => 'Select Category'] + $categories->pluck('name', 'id')->toArray()" required />
            <x-select-field label="Status" name="status" :options="['' => 'Select Status', '1' => 'Active', '0' => 'Inactive']"
                value="{{ old('status', '1') }}" required />
            <div>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition shadow-sm">
                    Create Sub-Category
                </button>
            </div>
        </form>
    </div>
    {{-- form end here --}}
@endsection