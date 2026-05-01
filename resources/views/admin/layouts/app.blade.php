@php
    use App\Models\Setting;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page-title') | {{ Setting::get('site_name', 'Site Name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ Setting::get('site_favicon', asset('img/borniesLogo.webp')) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body class="flex h-screen bg-[#f8fafc] text-slate-800 font-sans overflow-hidden antialiased">

    {{-- Mobile Sidebar Overlay --}}
    <div id="sidebar-overlay"></div>

    {{-- Sidebar --}}
    @include('admin.partials.sidebar')

    {{-- Main Content Area --}}
    <div class="flex-1 flex flex-col relative overflow-y-auto overflow-x-hidden min-w-0">

        {{-- Navbar --}}
        @include('admin.partials.navbar')

        {{-- Page Content --}}
        <main class="p-4 md:p-8 lg:p-10 animate-fade-in">
            @yield('content')
        </main>


        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        @stack('scripts')

        {{-- Toast Notification System --}}

        <div id="toast-container" class="fixed bottom-5 right-5 z-[100] flex flex-col gap-3"></div>

        <script>
            function showToast(message, type = 'success') {
                const container = document.getElementById('toast-container');
                const toast = document.createElement('div');
                const bgColor = type === 'success' ? 'bg-emerald-500' : 'bg-rose-500';
                const icon = type === 'success' ?
                    '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>' :
                    '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';

                toast.className = `${bgColor} text-white px-5 py-3 rounded-xl shadow-2xl flex items-center gap-3 animate-slide-in-right transition-all duration-300`;
                toast.innerHTML = `
                    <div class="p-1 bg-white/20 rounded-lg">${icon}</div>
                    <span class="text-sm font-bold tracking-wide">${message}</span>
                `;

                container.appendChild(toast);

                setTimeout(() => {
                    toast.classList.add('opacity-0', 'translate-x-full');
                    setTimeout(() => toast.remove(), 300);
                }, 5000);
            }

            @if(session('success'))
                showToast("{{ session('success') }}", 'success');
            @endif

            @if(session('error'))
                showToast("{{ session('error') }}", 'error');
            @endif
        </script>
        {{-- scripts end here --}}

    </div>

</body>

</html>