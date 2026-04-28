<nav class="h-[72px] bg-white/70 backdrop-blur-xl border-b border-slate-200/60 flex items-center justify-between px-4 md:px-8 sticky top-0 z-10 shadow-sm w-full">
    <div class="flex items-center gap-3">
        <!-- Hamburger Menu for Mobile -->
        <button id="mobile-menu-btn" class="md:hidden text-slate-600 hover:text-slate-800 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <div class="text-base md:text-lg font-semibold text-slate-800 truncate">
            BorniesBlog Admin Overview
        </div>
    </div>

    <div class="flex items-center gap-4">
        <div class="flex items-center gap-2 md:gap-3 text-xs md:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-full pl-3 pr-1 py-1 shadow-sm hover:shadow-md transition-shadow cursor-pointer">
            <span class="text-slate-600 whitespace-nowrap">{{ auth()->user()->name ?? 'Administrator' }}</span>
            <div class="w-6 h-6 md:w-8 md:h-8 rounded-full bg-indigo-100 text-indigo-700 font-bold flex items-center justify-center border border-indigo-200">
                {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.querySelector('.admin-sidebar');
        
        if (mobileMenuBtn && sidebar) {
            mobileMenuBtn.addEventListener('click', function() {
                sidebar.classList.toggle('hidden');
                // Ensure it takes full width/proper height on mobile
                if (!sidebar.classList.contains('hidden')) {
                    sidebar.classList.add('absolute', 'inset-y-0', 'left-0', 'h-full');
                } else {
                    sidebar.classList.remove('absolute', 'inset-y-0', 'left-0', 'h-full');
                }
            });
        }
    });
</script>