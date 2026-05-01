<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Bornies Blog</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="h-full">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm text-center">

            {{-- Lock Icon --}}
            <div class="mx-auto w-20 h-20 rounded-2xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                </svg>
            </div>

            <h2 class="text-2xl font-bold tracking-tight text-white">Forgot your password?</h2>
            <p class="mt-3 text-sm text-gray-400 leading-relaxed">
                Password resets for this admin panel are managed by the site administrator.
                Self-service reset is not available for security reasons.
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-sm">

            {{-- Contact Card --}}
            <div class="rounded-2xl bg-white/5 border border-white/10 p-6 space-y-4">
                <p class="text-sm font-semibold text-gray-300 uppercase tracking-wider">Contact Administrator</p>

                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-indigo-500/20 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Email</p>
                        <a href="mailto:{{ config('mail.from.address', 'admin@borniesblog.com') }}"
                            class="text-sm text-indigo-400 hover:text-indigo-300 font-medium transition-colors">
                            {{ config('mail.from.address', 'admin@borniesblog.com') }}
                        </a>
                    </div>
                </div>

                <div class="flex items-start gap-3 pt-2 border-t border-white/10">
                    <div class="w-9 h-9 rounded-lg bg-amber-500/20 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-xs text-gray-500 leading-relaxed">
                        Please include your registered email address and a brief description of your issue when contacting the admin.
                        Response time is typically within 24 hours.
                    </p>
                </div>
            </div>

            {{-- Back to Login --}}
            <div class="mt-6 text-center">
                <a href="{{ route('login.view') }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-400 hover:text-indigo-300 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Login
                </a>
            </div>
        </div>
    </div>
</body>
</html>
