<aside id="sidebar-container"
    class="hidden md:flex w-[260px] bg-slate-900 border-r border-slate-800/60 text-slate-100 flex-col shadow-[4px_0_24px_rgba(0,0,0,0.2)] relative z-20 shrink-0">

    {{-- Logo / Brand --}}
    <div class="h-[70px] flex items-center justify-between px-4 border-b border-white/[0.06] shrink-0 sidebar-brand-wrap">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 min-w-0">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shrink-0 shadow-lg shadow-indigo-900/40">
                <img src="{{ asset('img/borniesLogo.webp') }}" alt="Logo" class="w-8 h-8 rounded-xl object-cover">
            </div>
            <div class="sidebar-brand-text min-w-0 overflow-hidden">
                <span class="font-black text-[15px] tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-blue-300 via-indigo-300 to-purple-300 leading-none block whitespace-nowrap">BorniesBlog</span>
                <span class="text-[10px] text-slate-500 font-medium tracking-widest uppercase whitespace-nowrap">Admin Panel</span>
            </div>
        </a>
        {{-- Mobile Close Button --}}
        <button id="mobile-close-btn"
            class="md:hidden flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-all duration-150 shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto min-h-0 py-4 px-2 flex flex-col">

        <p class="nav-section-label sidebar-section-label">Main</p>

        <a href="{{ route('admin.dashboard') }}" data-tooltip="Dashboard"
            class="sidebar-nav-link group flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'sidebar-link-active bg-indigo-500/10 text-indigo-400 font-semibold' : 'text-slate-400 hover:bg-white/[0.05] hover:text-slate-200' }}">
            <span class="sidebar-icon-wrap flex items-center justify-center w-8 h-8 rounded-lg shrink-0 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-500/20 text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }} transition-colors duration-200">
                <svg width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
            </span>
            <span class="sidebar-label text-[13px] tracking-wide font-medium whitespace-nowrap overflow-hidden">Dashboard</span>
        </a>

        <a href="{{ route('posts.index') }}" data-tooltip="Posts"
            class="sidebar-nav-link group flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 mt-0.5 {{ request()->routeIs('posts.*') ? 'sidebar-link-active bg-indigo-500/10 text-indigo-400 font-semibold' : 'text-slate-400 hover:bg-white/[0.05] hover:text-slate-200' }}">
            <span class="sidebar-icon-wrap flex items-center justify-center w-8 h-8 rounded-lg shrink-0 {{ request()->routeIs('posts.*') ? 'bg-indigo-500/20 text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }} transition-colors duration-200">
                <svg width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </span>
            <span class="sidebar-label text-[13px] tracking-wide font-medium whitespace-nowrap overflow-hidden">Posts</span>
        </a>

        <p class="nav-section-label sidebar-section-label">Content</p>

        <a href="{{ route('categories.index') }}" data-tooltip="Categories"
            class="sidebar-nav-link group flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 mt-0.5 {{ request()->routeIs('categories.*') ? 'sidebar-link-active bg-indigo-500/10 text-indigo-400 font-semibold' : 'text-slate-400 hover:bg-white/[0.05] hover:text-slate-200' }}">
            <span class="sidebar-icon-wrap flex items-center justify-center w-8 h-8 rounded-lg shrink-0 {{ request()->routeIs('categories.*') ? 'bg-indigo-500/20 text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }} transition-colors duration-200">
                <svg width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </span>
            <span class="sidebar-label text-[13px] tracking-wide font-medium whitespace-nowrap overflow-hidden">Categories</span>
        </a>

        <a href="{{ route('subcategories.index') }}" data-tooltip="Sub-Categories"
            class="sidebar-nav-link group flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 mt-0.5 {{ request()->routeIs('subcategories.*') ? 'sidebar-link-active bg-indigo-500/10 text-indigo-400 font-semibold' : 'text-slate-400 hover:bg-white/[0.05] hover:text-slate-200' }}">
            <span class="sidebar-icon-wrap flex items-center justify-center w-8 h-8 rounded-lg shrink-0 {{ request()->routeIs('subcategories.*') ? 'bg-indigo-500/20 text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }} transition-colors duration-200">
                <svg width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
            </span>
            <span class="sidebar-label text-[13px] tracking-wide font-medium whitespace-nowrap overflow-hidden">Sub-Categories</span>
        </a>

        <a href="{{ route('tags.index') }}" data-tooltip="Tags"
            class="sidebar-nav-link group flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 mt-0.5 {{ request()->routeIs('tags.*') ? 'sidebar-link-active bg-indigo-500/10 text-indigo-400 font-semibold' : 'text-slate-400 hover:bg-white/[0.05] hover:text-slate-200' }}">
            <span class="sidebar-icon-wrap flex items-center justify-center w-8 h-8 rounded-lg shrink-0 {{ request()->routeIs('tags.*') ? 'bg-indigo-500/20 text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }} transition-colors duration-200">
                <svg width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
            </span>
            <span class="sidebar-label text-[13px] tracking-wide font-medium whitespace-nowrap overflow-hidden">Tags</span>
        </a>

        <p class="nav-section-label sidebar-section-label">Settings</p>

        @if(auth()->user()->is_admin)
        <a href="{{ route('users.index') }}" data-tooltip="Users"
            class="sidebar-nav-link group flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 mt-0.5 {{ request()->routeIs('users.*') ? 'sidebar-link-active bg-indigo-500/10 text-indigo-400 font-semibold' : 'text-slate-400 hover:bg-white/[0.05] hover:text-slate-200' }}">
            <span class="sidebar-icon-wrap flex items-center justify-center w-8 h-8 rounded-lg shrink-0 {{ request()->routeIs('users.*') ? 'bg-indigo-500/20 text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }} transition-colors duration-200">
                <svg width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </span>
            <span class="sidebar-label text-[13px] tracking-wide font-medium whitespace-nowrap overflow-hidden">Users</span>
        </a>
        @endif

    </nav>

    {{-- Footer: Logout + User --}}
    <div class="p-2 border-t border-white/[0.06] shrink-0">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" data-tooltip="Sign Out"
                class="sidebar-logout-btn sidebar-nav-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-rose-400/80 hover:text-rose-300 hover:bg-rose-500/10 transition-all duration-200 group">
                <span class="sidebar-icon-wrap flex items-center justify-center w-8 h-8 rounded-lg bg-rose-500/10 group-hover:bg-rose-500/20 text-rose-400 transition-colors duration-200 shrink-0">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </span>
                <span class="sidebar-label sidebar-logout-text text-[13px] font-semibold tracking-wide whitespace-nowrap overflow-hidden">Sign Out</span>
            </button>
        </form>

        <div class="sidebar-user-row flex items-center gap-2.5 mt-1.5 px-3 py-2 rounded-lg bg-white/[0.03]">
            <div class="w-7 h-7 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white text-xs font-bold shrink-0">
                {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
            </div>
            <div class="sidebar-user-info min-w-0 overflow-hidden">
                <p class="text-[12px] font-semibold text-slate-300 truncate whitespace-nowrap">{{ auth()->user()->name ?? 'Administrator' }}</p>
                <p class="text-[10px] text-slate-500 truncate whitespace-nowrap">{{ auth()->user()->email ?? '' }}</p>
            </div>
        </div>
    </div>

</aside>