@extends('admin.layouts.app')
@section('content')
    <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Tags', 'url' => route('tags.index')],
            ['label' => 'Create Tag']
        ]">
    </x-breadcrumb>
    <x-page-header title="Create New Tag" subtitle="Add a new tag to organize your posts" buttonLabel="Back to Tags"
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
        <form action="{{ route('tags.store') }}" method="post" class="space-y-6">
            @csrf
            <x-input-field label="Tag Name" name="name" placeholder="Enter tag name" required />
            <x-select-field label="Status" name="status" :options="['1' => 'Active', '0' => 'Inactive']"
                value="{{ old('status', '1') }}" required />
            <div>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition shadow-sm">
                    Create Tag
                </button>
            </div>
        </form>
    </div>
@endsection