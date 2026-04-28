<aside id="sidebar-container"
    class="hidden md:flex w-[260px] bg-slate-900 border-r border-slate-800 text-slate-100 flex-col transition-transform duration-300 shadow-[8px_0_32px_rgba(0,0,0,0.15)] relative z-20">

    <div class="h-20 flex items-center justify-center px-6 border-b border-white/5 bg-slate-900/50 backdrop-blur-md">
        <img src="{{ asset('img/borniesLogo.webp') }}" alt="BorniesBlog Logo"
            class="w-15 h-15 mr-4 rounded-full object-cover">
        <span
            class="font-black text-2xl tracking-tighter bg-clip-text text-transparent bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400 drop-shadow-sm">BorniesBlog</span>
    </div>

    <nav class="flex-1 overflow-y-auto py-8 px-4 flex flex-col gap-1.5">
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-500/10 text-indigo-400 font-semibold shadow-sm' : 'text-slate-400 hover:bg-slate-800/80 hover:text-slate-200' }}">
            <svg class="mr-3 transition-transform duration-300 group-hover:scale-110 {{ request()->routeIs('admin.dashboard') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }}"
                width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                </path>
            </svg>
            <span class="text-sm tracking-wide">Dashboard</span>
        </a>

        <a href="{{ route('users.index') }}"
            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group text-slate-400 hover:bg-slate-800/80 hover:text-slate-200">
            <svg class="mr-3 text-slate-500 group-hover:text-slate-300 transition-transform duration-300 group-hover:scale-110"
                width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                </path>
            </svg>
            <span class="text-sm tracking-wide">Users</span>
        </a>



        <a href="{{ route('categories.index') }}"
            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('categories.*') ? 'bg-indigo-500/10 text-indigo-400 font-semibold shadow-sm' : 'text-slate-400 hover:bg-slate-800/80 hover:text-slate-200' }}">
            <svg class="mr-3 transition-transform duration-300 group-hover:scale-110 {{ request()->routeIs('categories.*') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }}"
                width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                </path>
            </svg>
            <span class="text-sm tracking-wide">Categories</span>
        </a>
        <a href="{{ route('subcategories.index') }}"
            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('subcategories.*') ? 'bg-indigo-500/10 text-indigo-400 font-semibold shadow-sm' : 'text-slate-400 hover:bg-slate-800/80 hover:text-slate-200' }}">
            <svg class="mr-3 transition-transform duration-300 group-hover:scale-110 {{ request()->routeIs('subcategories.*') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }}"
                width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                </path>
            </svg>
            <span class="text-sm tracking-wide">Sub-Categories</span>
        </a>
        <a href="{{ route('posts.index') }}"
            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.posts') ? 'bg-indigo-500/10 text-indigo-400 font-semibold shadow-sm' : 'text-slate-400 hover:bg-slate-800/80 hover:text-slate-200' }}">
            <svg class="mr-3 transition-transform duration-300 group-hover:scale-110 {{ request()->routeIs('admin.posts') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }}"
                width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4v4h4M12 11h.01M12 15h.01">
                </path>
            </svg>
            <span class="text-sm tracking-wide">Posts</span>
        </a>

        <a href="{{ route('tags.index') }}"
            class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('tags.*') ? 'bg-indigo-500/10 text-indigo-400 font-semibold shadow-sm' : 'text-slate-400 hover:bg-slate-800/80 hover:text-slate-200' }}">
            <svg class="mr-3 transition-transform duration-300 group-hover:scale-110 {{ request()->routeIs('tags.*') ? 'text-indigo-400' : 'text-slate-500 group-hover:text-slate-300' }}"
                width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                </path>
            </svg>
            <span class="text-sm tracking-wide">Tags</span>
        </a>
    </nav>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button
            class="mt-auto mx-4 mb-6 flex justify-center items-center gap-2 px-4 py-3 w-[calc(100%-2rem)] text-sm font-semibold tracking-wide text-red-400 bg-red-400/5 hover:bg-red-500/10 rounded-lg transition-all duration-200 border border-red-500/10 hover:border-red-500/30"
            type="submit">
            <svg class="text-red-400" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                </path>
            </svg>
            Logout
        </button>
    </form>

</aside>