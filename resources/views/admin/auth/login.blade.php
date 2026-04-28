<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-900">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

<body class="h-full">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img src="{{ url('img/borniesLogo.webp') }}" alt="Bornies Blog" class="mx-auto h-30 w-30 rounded-full " />
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-white">Sign in to your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-100">Email address</label>
                    <div class="mt-2">
                        <input id="email" name="email" placeholder="admin@gmail.com" autocomplete="email"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        @error('email')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm/6 font-medium text-gray-100">Password</label>
                        {{-- <div class="text-sm">
                            <a href="#" class="font-semibold text-indigo-400 hover:text-indigo-300">Forgot
                                password?</a>
                        </div> --}}
                    </div>
                
                    <div class="mt-2">
                        <input id="password" type="password" name="password" placeholder="********"
                            autocomplete="current-password"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        @error('password')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <div class="flex items-center justify-between mt-3">
                            <label for="remeber" class="block text-sm/6 font-medium text-gray-100">Remember me?</label>
                            <div class="text-sm">
                                <a href="#" class="font-semibold text-indigo-400 hover:text-indigo-300">Forgot
                                    password?</a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <input type="checkbox" name="remember" id="remeber"
                                class="block w-4 h-4 rounded-md bg-white/5 px-3 py-1.5">
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Sign
                        in</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm/6 text-gray-400">
                Not a member?
                <a href="{{ route('register.view') }}"
                    class="font-semibold text-indigo-400 hover:text-indigo-300">Register here</a>
            </p>
        </div>
    </div>

</body>

</html>
