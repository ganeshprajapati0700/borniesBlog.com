<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-900">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Register Page | Bornies Blog</title>
</head>

<body class="h-full">
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img src="{{ url('img/borniesLogo.webp') }}" alt="Bornies Blog" class="mx-auto h-30 w-30 rounded-full " />
            <h2 class="mt-8 text-center text-2xl/2 font-bold tracking-tight text-white">Register your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form action="{{ route('admin.register') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm/6 font-medium text-gray-100">Name</label>
                    <div class="mt-2">
                        <input id="name" name="name" placeholder="Admin" autocomplete="name"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        @error('name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
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
                    </div>
                    <div class="mt-2 relative">
                        <input id="password" type="password" name="password" placeholder="********"
                            autocomplete="new-password" required
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 pr-10 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 transition-colors sm:text-sm/6" />
                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-200 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                        @error('password')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Validation rules list -->
                    <ul id="passwordRules" class="hidden mt-3 text-sm text-gray-500 space-y-1">
                        <li id="rule-length" class="flex items-center"><svg class="w-4 h-4 mr-1.5 text-gray-600"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>At least 10 characters</li>
                        <li id="rule-upper" class="flex items-center"><svg class="w-4 h-4 mr-1.5 text-gray-600"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>One uppercase letter</li>
                        <li id="rule-lower" class="flex items-center"><svg class="w-4 h-4 mr-1.5 text-gray-600"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>One lowercase letter</li>
                        <li id="rule-number" class="flex items-center"><svg class="w-4 h-4 mr-1.5 text-gray-600"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>One number</li>
                        <li id="rule-special" class="flex items-center"><svg class="w-4 h-4 mr-1.5 text-gray-600"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>One special character</li>
                    </ul>
                </div>
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-100">Confirm
                            Password</label>
                    </div>
                    <div class="mt-2 relative">
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            placeholder="********" autocomplete="new-password" required
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 pr-10 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 transition-colors sm:text-sm/6" />
                        <button type="button" id="toggleConfirmPassword"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-200 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                        @error('password_confirmation')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Register</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm/6 text-gray-400">
                if a member?
                <a href="{{ route('login.view') }}" class="font-semibold text-indigo-400 hover:text-indigo-300">Sign in
                    here</a>
            </p>
        </div>
    </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var password = document.getElementById("password");
            var confirm_password = document.getElementById("password_confirmation");

            // Toggle Eye icons
            function setupToggle(btnId, inputId) {
                var btn = document.getElementById(btnId);
                var input = document.getElementById(inputId);
                btn.addEventListener('click', function () {
                    if (input.type === "password") {
                        input.type = "text";
                        btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" /></svg>`;
                    } else {
                        input.type = "password";
                        btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>`;
                    }
                });
            }

            setupToggle('togglePassword', 'password');
            setupToggle('toggleConfirmPassword', 'password_confirmation');

            // Validation rules regex
            const rules = {
                length: /.{10,}/,
                upper: /[A-Z]/,
                lower: /[a-z]/,
                number: /[0-9]/,
                special: /[@$!%*#?&]/
            };

            function updateRuleUI(ruleId, isValid) {
                const li = document.getElementById(`rule-${ruleId}`);
                const svg = li.querySelector('svg');
                if (isValid) {
                    li.classList.remove('text-gray-500');
                    li.classList.add('text-green-500');
                    svg.classList.remove('text-gray-600');
                    svg.classList.add('text-green-500');
                } else {
                    li.classList.remove('text-green-500');
                    li.classList.add('text-gray-500');
                    svg.classList.remove('text-green-500');
                    svg.classList.add('text-gray-600');
                }
            }

            function setBorderColor(input, isValid, isEmpty) {
                input.classList.remove('outline-white/10', 'focus:outline-indigo-500', 'outline-red-500', 'focus:outline-red-500', 'outline-green-500', 'focus:outline-green-500');

                if (isEmpty) {
                    input.classList.add('outline-white/10', 'focus:outline-indigo-500');
                } else if (isValid) {
                    input.classList.add('outline-green-500', 'focus:outline-green-500');
                } else {
                    input.classList.add('outline-red-500', 'focus:outline-red-500');
                }
            }

            function checkPassword() {
                const val = password.value;
                let allValid = true;

                for (const [key, regex] of Object.entries(rules)) {
                    const isValid = regex.test(val);
                    updateRuleUI(key, isValid);
                    if (!isValid) allValid = false;
                }

                setBorderColor(password, allValid, val === '');
                checkConfirmPassword();
            }

            function checkConfirmPassword() {
                const pVal = password.value;
                const cVal = confirm_password.value;

                if (cVal === '') {
                    setBorderColor(confirm_password, false, true);
                    confirm_password.setCustomValidity('');
                } else if (pVal !== cVal) {
                    confirm_password.setCustomValidity("Passwords Don't Match");
                    setBorderColor(confirm_password, false, false);
                } else {
                    confirm_password.setCustomValidity('');
                    setBorderColor(confirm_password, true, false);
                }
            }

            password.addEventListener('input', checkPassword);
            password.addEventListener('focus', function() {
                document.getElementById('passwordRules').classList.remove('hidden');
            });
            confirm_password.addEventListener('input', checkConfirmPassword);
        });
    </script>
</body>

</html>