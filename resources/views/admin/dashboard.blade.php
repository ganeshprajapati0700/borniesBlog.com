@extends('admin.layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <h3 class="text-2xl md:text-3xl font-bold text-slate-800 mb-6 md:mb-8 tracking-tight drop-shadow-sm">Dashboard Overview</h3>
    </div>

    @if (session('success'))
        <div class="mb-8 p-4 rounded-xl flex items-center gap-3 shadow-md animate-slide-in text-sm md:text-base bg-emerald-50 text-emerald-800 border-l-4 border-emerald-500">
            <svg width="24" height="24" class="text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8 mb-10 bg-transparent">

        <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-slate-100 relative overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1.5 group">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-indigo-600 transition-all duration-500 opacity-80 group-hover:opacity-100 group-hover:h-1.5"></div>
            <div class="text-xs md:text-sm font-bold text-slate-400 uppercase tracking-widest mb-3 flex items-center justify-between">
                Total Users
                <div class="opacity-20 group-hover:opacity-100 transition-all duration-300 transform group-hover:scale-110 text-indigo-500">
                    <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
            <h2 class="text-4xl md:text-5xl font-black text-slate-800 tracking-tight">{{ $stats['users'] ?? 0 }}</h2>
        </div>

        <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-slate-100 relative overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1.5 group">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-teal-400 to-emerald-500 transition-all duration-500 opacity-80 group-hover:opacity-100 group-hover:h-1.5"></div>
            <div class="text-xs md:text-sm font-bold text-slate-400 uppercase tracking-widest mb-3 flex items-center justify-between">
                Active Users
                <div class="opacity-20 group-hover:opacity-100 transition-all duration-300 transform group-hover:scale-110 text-emerald-500">
                    <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                </div>
            </div>
            <h2 class="text-4xl md:text-5xl font-black text-slate-800 tracking-tight">{{ $stats['active_users'] ?? 0 }}</h2>
        </div>

        <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-slate-100 relative overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1.5 group">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 to-pink-500 transition-all duration-500 opacity-80 group-hover:opacity-100 group-hover:h-1.5"></div>
            <div class="text-xs md:text-sm font-bold text-slate-400 uppercase tracking-widest mb-3 flex items-center justify-between">
                Total Posts
                <div class="opacity-20 group-hover:opacity-100 transition-all duration-300 transform group-hover:scale-110 text-purple-500">
                    <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 4v4h4M12 11h.01M12 15h.01"></path></svg>
                </div>
            </div>
            <h2 class="text-4xl md:text-5xl font-black text-slate-800 tracking-tight">{{ $stats['posts'] ?? 0 }}</h2>
        </div>

    </div>
@endsection
