<nav class="h-[70px] bg-white/80 backdrop-blur-xl border-b border-slate-200/60 flex items-center justify-between px-4 md:px-6 sticky top-0 z-10 shadow-[0_1px_12px_rgba(0,0,0,0.06)] w-full shrink-0">

    {{-- Left: Toggle + Page Title --}}
    <div class="flex items-center gap-3 min-w-0">

        {{-- Desktop Sidebar Toggle --}}
        <button id="desktop-toggle-btn"
            class="hidden md:flex items-center justify-center w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-900 transition-all duration-150 focus:outline-none shrink-0"
            aria-label="Toggle Sidebar">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        {{-- Mobile Hamburger --}}
        <button id="mobile-menu-btn"
            class="md:hidden flex items-center justify-center w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-900 transition-all duration-150 focus:outline-none shrink-0"
            aria-label="Open Menu">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        {{-- Page context --}}
        <div class="min-w-0">
            <h1 class="text-[15px] md:text-[16px] font-bold text-slate-800 truncate leading-tight">
                @yield('page-title', 'Dashboard')
            </h1>
            <p class="hidden sm:block text-[11px] text-slate-400 font-medium truncate leading-tight">
                {{ App\Models\Setting::get('site_name', 'Site Name') }} Admin Panel
            </p>
        </div>
    </div>

    {{-- Right: Actions --}}
    <div class="flex items-center gap-2 md:gap-3 shrink-0">

        {{-- Add New Post shortcut --}}
        <a href="{{ route('posts.create') }}"
            class="hidden sm:flex items-center gap-2 px-3 py-2 text-[12px] font-semibold text-white bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 rounded-lg shadow-sm shadow-indigo-200 hover:shadow-md hover:shadow-indigo-200 transition-all duration-200">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            New Post
        </a>

        {{-- User Avatar / Profile --}}
        <div class="flex items-center gap-2 pl-2.5 pr-1.5 py-1.5 bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200 cursor-pointer">
            <div class="hidden sm:block min-w-0">
                <p class="text-[12px] font-semibold text-slate-700 leading-tight truncate max-w-[120px]">
                    {{ auth()->user()->name ?? 'Administrator' }}
                </p>
                <p class="text-[10px] text-slate-400 leading-tight truncate max-w-[120px]">
                    {{ auth()->user()->email ?? 'admin' }}
                </p>
            </div>
            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-400 to-purple-500 text-white font-bold text-sm flex items-center justify-center shadow-sm shrink-0">
                {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
            </div>
        </div>

    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar       = document.getElementById('sidebar-container');
        const overlay       = document.getElementById('sidebar-overlay');
        const desktopToggle = document.getElementById('desktop-toggle-btn');
        const mobileBtn     = document.getElementById('mobile-menu-btn');

        // ── Desktop: collapse / expand ──────────────────────────────
        const STORAGE_KEY = 'sidebar_collapsed';
        const isCollapsed = localStorage.getItem(STORAGE_KEY) === 'true';

        if (isCollapsed) {
            sidebar.classList.add('sidebar-collapsed');
        }

        if (desktopToggle) {
            desktopToggle.addEventListener('click', function () {
                sidebar.classList.toggle('sidebar-collapsed');
                localStorage.setItem(
                    STORAGE_KEY,
                    sidebar.classList.contains('sidebar-collapsed')
                );
            });
        }

        // ── Mobile: slide-in drawer ──────────────────────────────────
        function openSidebar() {
            sidebar.classList.add('mobile-open');
            sidebar.classList.remove('sidebar-collapsed'); // always full width on mobile
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
            // restore collapsed state on mobile close
            if (localStorage.getItem(STORAGE_KEY) === 'true') {
                sidebar.classList.add('sidebar-collapsed');
            }
        }

        if (mobileBtn) {
            mobileBtn.addEventListener('click', openSidebar);
        }

        document.addEventListener('click', function (e) {
            if (e.target.closest('#mobile-close-btn')) {
                closeSidebar();
            }
        });

        if (overlay) {
            overlay.addEventListener('click', closeSidebar);
        }

        window.addEventListener('resize', function () {
            if (window.innerWidth >= 768) {
                closeSidebar();
            }
        });
    });
</script>