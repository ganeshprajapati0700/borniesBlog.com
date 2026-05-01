@extends('admin.layouts.app')
@section('content')
    <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Tags', 'url' => route('tags.index')],
            ['label' => 'Edit Tag']
        ]">
    </x-breadcrumb>
    <x-page-header title="Edit Tag" subtitle="Edit tag to organize your posts" buttonLabel="Back to tags"
        buttonUrl="{{ route('tags.index') }}" />
    @if ($errors->any())
        <div class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('tags.update', $tag->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')
            <x-input-field label="Sub-Category Name" name="name" placeholder="Enter sub-category name" required
                value="{{ $tag->name }}" />
            <x-select-field label="Status" name="status" :options="['1' => 'Active', '0' => 'Inactive']" required
                value="{{ $tag->status }}" />
            <div>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition shadow-sm">
                    Update Tag
                </button>
            </div>
        </form>
    </div>
@endsection