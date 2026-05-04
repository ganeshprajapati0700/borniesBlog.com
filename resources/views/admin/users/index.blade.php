@extends('admin.layouts.app')
@section('page-title', 'Users')
@section('content')
    <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Users']]"></x-breadcrumb>
    <x-page-header title="Users Overview" subtitle="Manage and view all your blog users" buttonLabel="+ Add New User"
        buttonUrl="{{ route('users.create') }}" />

    @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded">{{ session('error') }}</div>
    @endif

    <x-search-filter action="{{ route('users.index') }}">
        <x-input-field label="Search User" name="search" placeholder="Search by name & email..." />
        <x-select-field label="Role" name="role" :options="['' => 'All Roles', 'super_admin' => 'Super Admin', 'admin' => 'Admin', 'editor' => 'Editor', 'author' => 'Author']" />
        <x-select-field label="Status" name="status" :options="['' => 'All Status', 1 => 'Active', 0 => 'Inactive']"
            :value="request('status')" />
    </x-search-filter>

    {{-- Count bar --}}
    <div class="flex items-center justify-between mb-3 text-sm text-slate-500">
        <span>
            Showing <strong class="text-slate-700">{{ $data->count() }}</strong> of
            <strong class="text-slate-700">{{ $data->total() }}</strong> users
            @if (request()->hasAny(['search', 'role', 'status']) && array_filter(request()->only(['search', 'role', 'status'])))
                <span
                    class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold bg-indigo-50 text-indigo-600 border border-indigo-200">Filtered</span>
            @endif
        </span>
    </div>

    <x-data-table :columns="['ID', 'Name', 'Email', 'Role', 'Status', 'Action']">
        @forelse ($data as $user)
            <tr class="hover:bg-slate-50 transition">
                <x-table-cell type="id">#{{ $user->id }}</x-table-cell>
                <x-table-cell type="title">{{ $user->name }}</x-table-cell>
                <x-table-cell type="email">{{ $user->email }}</x-table-cell>
                <x-table-cell type="role">
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold
                                {{ $user->role === 'super_admin' ? 'bg-rose-50 text-rose-700 border border-rose-200' : 
                                   ($user->role === 'admin' ? 'bg-purple-50 text-purple-700 border border-purple-200' : 
                                   ($user->role === 'editor' ? 'bg-blue-50 text-blue-700 border border-blue-200' : 
                                   'bg-slate-50 text-slate-700 border border-slate-200')) }}">
                        {{ ucwords(str_replace('_', ' ', $user->role)) }}
                    </span>
                </x-table-cell>
                <x-table-cell type="status">
                    <button data-url="{{ route('users.toggle-status', $user->id) }}" data-status="{{ $user->status }}"
                        onclick="toggleStatus(this)"
                        class="status-toggle-btn inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold border cursor-pointer transition-all duration-200 {{ $user->status == 1 ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-amber-50 text-amber-700 border-amber-200' }}">
                        <span
                            class="w-1.5 h-1.5 rounded-full inline-block {{ $user->status == 1 ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                        <span class="label">{{ $user->status == 1 ? 'Active' : 'Inactive' }}</span>
                    </button>
                </x-table-cell>
                <x-table-cell type="action">
                    <x-action-buttons editUrl="{{ route('users.edit', $user->id) }}"
                        deleteUrl="{{ route('users.destroy', $user->id) }}" :itemId="$user->id" />
                </x-table-cell>
            </tr>
        @empty
            <x-empty-state colspan="6" message="No User found" submessage="Try adjusting your search filters" />
        @endforelse
    </x-data-table>

    <div class="mt-4 flex items-center justify-between text-sm text-slate-600">
        <span class="text-xs text-slate-400">Page {{ $data->currentPage() }} of {{ $data->lastPage() }}</span>
        <div>{{ $data->links() }}</div>
    </div>

    @include('admin.partials.status-toggle-script')
@endsection