@extends('admin.layouts.app')
@section('page-title', 'Activity Logs')
@section('content')
    <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Activity Logs']
        ]">
    </x-breadcrumb>
    <x-page-header title="Activity Logs" subtitle="Monitor administrative actions across the system" />

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-6 py-4 font-bold text-slate-700 uppercase tracking-wider text-[11px]">User</th>
                        <th class="px-6 py-4 font-bold text-slate-700 uppercase tracking-wider text-[11px]">Action</th>
                        <th class="px-6 py-4 font-bold text-slate-700 uppercase tracking-wider text-[11px]">Model</th>
                        <th class="px-6 py-4 font-bold text-slate-700 uppercase tracking-wider text-[11px]">Details</th>
                        <th class="px-6 py-4 font-bold text-slate-700 uppercase tracking-wider text-[11px]">IP Address</th>
                        <th class="px-6 py-4 font-bold text-slate-700 uppercase tracking-wider text-[11px]">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($logs as $log)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-slate-800">{{ $log->user->name ?? 'System' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-tighter
                                    {{ $log->action == 'created' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' :
                                       ($log->action == 'updated' ? 'bg-amber-50 text-amber-600 border border-amber-100' :
                                       ($log->action == 'deleted' ? 'bg-rose-50 text-rose-600 border border-rose-100' : 'bg-slate-50 text-slate-600 border border-slate-100')) }}">
                                    {{ $log->action }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-500 font-medium">{{ $log->model ?? '—' }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $log->details }}</td>
                            <td class="px-6 py-4 font-mono text-[11px] text-slate-400">{{ $log->ip_address }}</td>
                            <td class="px-6 py-4 text-slate-400 text-xs">{{ $log->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400 italic">No activity logs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6 border-t border-slate-100 bg-slate-50">
            {{ $logs->links() }}
        </div>
    </div>
@endsection
