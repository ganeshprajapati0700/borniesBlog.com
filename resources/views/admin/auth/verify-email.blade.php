<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-900">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-full">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img src="{{ url('img/borniesLogo.webp') }}" alt="Bornies Blog"
                class="mx-auto h-30 w-30 rounded-full object-cover" />
            <h2 class="mt-10 text-center text-2xl font-bold tracking-tight text-white">Verify Your Email</h2>
            <p class="mt-2 text-center text-sm text-gray-400">
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the
                link we just emailed to you?
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-sm">
            @if (session('success'))
                <div
                    class="mb-6 rounded-md bg-green-500/10 px-4 py-3 text-sm text-green-400 border border-green-500/20 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}" class="space-y-6">
                @csrf
                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 transition-colors shadow-sm">
                        Resend Verification Email
                    </button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-transparent px-3 py-2 text-sm font-semibold text-gray-300 border border-gray-600 hover:bg-white/5 hover:text-white transition-colors">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</body>

</html>