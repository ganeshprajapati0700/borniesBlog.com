@extends('admin.layouts.app')
@section('page-title', 'Dashboard')
@section('content')

    {{-- Flash message --}}
    @if (session('success'))
        <div class="mb-6 p-4 rounded-xl flex items-center gap-3 shadow-sm animate-slide-in text-sm bg-emerald-50 text-emerald-800 border border-emerald-200">
            <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Welcome back, {{ auth()->user()->name ?? 'Admin' }} 👋</h2>
            <p class="text-sm text-slate-400 mt-1">Here's what's happening with your blog today.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('posts.create') }}" class="inline-flex items-center gap-2 px-3 py-2 bg-indigo-600 text-white text-xs font-bold uppercase tracking-wider rounded-lg hover:bg-indigo-700 transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                New Post
            </a>
            <a href="{{ route('categories.create') }}" class="inline-flex items-center gap-2 px-3 py-2 bg-white text-slate-700 text-xs font-bold uppercase tracking-wider rounded-lg border border-slate-200 hover:bg-slate-50 transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Category
            </a>
            @if(auth()->user()->is_admin)
            <a href="{{ route('users.index') }}" class="inline-flex items-center gap-2 px-3 py-2 bg-white text-slate-700 text-xs font-bold uppercase tracking-wider rounded-lg border border-slate-200 hover:bg-slate-50 transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Users
            </a>
            @endif
        </div>
    </div>


    {{-- Primary Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group relative overflow-hidden">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center text-indigo-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <span class="text-xs font-semibold text-indigo-500 bg-indigo-50 px-2 py-1 rounded-full">Posts</span>
            </div>
            <p class="text-3xl font-black text-slate-800 tracking-tight">{{ number_format($stats['posts']) }}</p>
            <p class="text-xs text-slate-400 font-medium mt-1">Total articles</p>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group relative overflow-hidden">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">Live</span>
            </div>
            <p class="text-3xl font-black text-slate-800 tracking-tight">{{ number_format($stats['published']) }}</p>
            <p class="text-xs text-slate-400 font-medium mt-1">Published posts</p>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group relative overflow-hidden">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center text-amber-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2 py-1 rounded-full">Draft</span>
            </div>
            <p class="text-3xl font-black text-slate-800 tracking-tight">{{ number_format($stats['drafts']) }}</p>
            <p class="text-xs text-slate-400 font-medium mt-1">Pending drafts</p>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group relative overflow-hidden">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 rounded-xl bg-rose-100 flex items-center justify-center text-rose-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <span class="text-xs font-semibold text-rose-500 bg-rose-50 px-2 py-1 rounded-full">Views</span>
            </div>
            <p class="text-3xl font-black text-slate-800 tracking-tight">{{ number_format($stats['total_views']) }}</p>
            <p class="text-xs text-slate-400 font-medium mt-1">Total page views</p>
        </div>
    </div>

    {{-- Secondary Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow duration-200">
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
                <p class="text-2xl font-black text-slate-800">{{ number_format($stats['users']) }}</p>
                <p class="text-xs text-slate-400 font-medium">Total Users <span class="ml-2 text-emerald-600 font-semibold">{{ $stats['active_users'] }} active</span></p>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow duration-200">
            <div class="w-12 h-12 rounded-xl bg-violet-100 flex items-center justify-center text-violet-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <div>
                <p class="text-2xl font-black text-slate-800">{{ number_format($stats['categories']) }}</p>
                <p class="text-xs text-slate-400 font-medium">Categories</p>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow duration-200">
            <div class="w-12 h-12 rounded-xl bg-sky-100 flex items-center justify-center text-sky-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
            <div>
                <p class="text-2xl font-black text-slate-800">{{ number_format($stats['tags']) }}</p>
                <p class="text-xs text-slate-400 font-medium">Tags</p>
            </div>
        </div>
    </div>

    {{-- Monthly Posts Chart --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-[15px] font-bold text-slate-800">Monthly Posts Report</h3>
                <p class="text-xs text-slate-400 mt-0.5">Published vs Draft posts over the last 12 months</p>
            </div>
            <div class="flex items-center gap-4 text-[11px] font-semibold">
                <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-sm bg-indigo-500 inline-block"></span> Published</span>
                <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-sm bg-amber-400 inline-block"></span> Draft</span>
            </div>
        </div>
        <div class="relative h-64">
            <canvas id="monthlyPostsChart"></canvas>
        </div>
    </div>

    {{-- Recent Posts Table --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
            <div>
                <h3 class="text-[15px] font-bold text-slate-800">Recent Posts</h3>
                <p class="text-xs text-slate-400 mt-0.5">Last 6 published or drafted articles</p>
            </div>
            <a href="{{ route('posts.index') }}"
                class="text-xs font-semibold text-indigo-600 hover:text-indigo-700 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition-colors duration-150">
                View All →
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3">Title</th>
                        <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-4 py-3 hidden md:table-cell">Author</th>
                        <th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wider px-4 py-3 hidden lg:table-cell">Category</th>
                        <th class="text-center text-xs font-semibold text-slate-500 uppercase tracking-wider px-4 py-3">Status</th>
                        <th class="text-right text-xs font-semibold text-slate-500 uppercase tracking-wider px-6 py-3 hidden sm:table-cell">Views</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($recentPosts as $post)
                        <tr class="hover:bg-slate-50/70 transition-colors duration-150">
                            <td class="px-6 py-4">
                                <div class="max-w-[220px] sm:max-w-xs">
                                    <a href="{{ route('posts.edit', $post->id) }}"
                                        class="text-[13px] font-semibold text-slate-800 hover:text-indigo-600 transition-colors truncate block">
                                        {{ $post->title }}
                                    </a>
                                    <span class="text-[11px] text-slate-400">{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 hidden md:table-cell">
                                <span class="text-[13px] text-slate-600 font-medium">{{ $post->author?->name ?? '—' }}</span>
                            </td>
                            <td class="px-4 py-4 hidden lg:table-cell">
                                <span class="text-[12px] text-slate-500 bg-slate-100 px-2 py-0.5 rounded-md font-medium">
                                    {{ $post->category?->name ?? '—' }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-center">
                                @if ($post->status == 1)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 inline-block"></span>Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right hidden sm:table-cell">
                                <span class="text-[13px] font-semibold text-slate-700">{{ number_format($post->views) }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400 text-sm">
                                No posts yet. <a href="{{ route('posts.create') }}" class="text-indigo-600 font-semibold hover:underline">Create your first post →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Chart.js script --}}
    <script>
        (function () {
            const labels    = @json($chartLabels);
            const published = @json($chartPublished);
            const drafts    = @json($chartDrafts);

            const ctx = document.getElementById('monthlyPostsChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [
                        {
                            label: 'Published',
                            data: published,
                            backgroundColor: 'rgba(99, 102, 241, 0.85)',
                            borderRadius: 6,
                            borderSkipped: false,
                        },
                        {
                            label: 'Draft',
                            data: drafts,
                            backgroundColor: 'rgba(251, 191, 36, 0.75)',
                            borderRadius: 6,
                            borderSkipped: false,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            titleColor: '#e2e8f0',
                            bodyColor: '#94a3b8',
                            padding: 12,
                            cornerRadius: 8,
                        },
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { color: '#94a3b8', font: { size: 11 } },
                        },
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(148, 163, 184, 0.1)' },
                            ticks: { color: '#94a3b8', font: { size: 11 }, stepSize: 1 },
                        },
                    },
                },
            });
        })();
    </script>

@endsection
