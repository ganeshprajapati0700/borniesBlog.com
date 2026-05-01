<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - BorniesBlog</title>
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
        {{-- scripts start here --}}
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        @stack('scripts')
        <script>
            // time interval for success and error messages
            setTimeout(function () {
                $('.bg-green-100, .bg-red-100').fadeOut('slow');
            }, 5000);
        </script>
        {{-- scripts end here --}}
    </div>

</body>

</html>