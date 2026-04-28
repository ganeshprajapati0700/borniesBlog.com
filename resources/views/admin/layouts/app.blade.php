<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel - BorniesBlog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    {{-- <style type="text/tailwindcss">
        @import "{{ asset('css/admin.css') }}";
    </style> --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body class="flex h-screen bg-[#f8fafc] text-slate-800 font-sans overflow-hidden antialiased">

    {{-- Sidebar --}}
    @include('admin.partials.sidebar')

    {{-- Main Content Area --}}
    <div class="flex-1 flex flex-col relative overflow-y-auto overflow-x-hidden">

        {{-- Navbar --}}
        @include('admin.partials.navbar')

        {{-- Page Content --}}
        <main class="p-4 md:p-8 lg:p-10 animate-fade-in">
            @yield('content')
        </main>

    </div>

</body>

</html>