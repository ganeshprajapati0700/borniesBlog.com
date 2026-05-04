@extends('admin.layouts.app')
@section('content')
    <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Users', 'url' => route('users.index')],
            ['label' => 'Edit User']
        ]">
    </x-breadcrumb>
    <x-page-header title="Edit a user" subtitle="Edit a user to organize your posts" buttonLabel="Back to Users"
        buttonUrl="{{ route('users.index') }}" />
    @if ($errors->any())
        <div class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- @dd($user); --}}
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('users.update', $user->id) }}" method="post" class="space-y-6">
            @csrf
            @method('PATCH')
            <x-input-field label="User Name" type="text" name="name" placeholder="Admin" value="{{ $user->name }}"
                required />
            <x-input-field label="User Email" type="email" name="email" placeholder="admin@gmail.com"
                value="{{ $user->email }}" required />
            <x-input-field label="User Mobile" type="tel" name="mobile" placeholder="9876543210" value="{{ $user->mobile }}"
                required />
            <x-select-field label="User Role" name="role" :options="['super_admin' => 'Super Admin', 'admin' => 'Admin', 'editor' => 'Editor', 'author' => 'Author']"
                value="{{ $user->role }}" required />
            <x-select-field label="Status" name="status" :options="['1' => 'Active', '0' => 'Inactive']"
                value="{{ $user->status }}" required />
            <div class="space-y-4">
                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" placeholder="******"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-500 hover:text-slate-700 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                    <!-- Validation rules list -->
                    <ul id="passwordRules" class="hidden mt-2 text-sm text-slate-500 space-y-1">
                        <li id="rule-length" class="flex items-center"><svg class="w-4 h-4 mr-1.5 text-slate-300"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>At least 10 characters</li>
                        <li id="rule-upper" class="flex items-center"><svg class="w-4 h-4 mr-1.5 text-slate-300"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>One uppercase letter</li>
                        <li id="rule-lower" class="flex items-center"><svg class="w-4 h-4 mr-1.5 text-slate-300"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>One lowercase letter</li>
                        <li id="rule-number" class="flex items-center"><svg class="w-4 h-4 mr-1.5 text-slate-300"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>One number</li>
                        <li id="rule-special" class="flex items-center"><svg class="w-4 h-4 mr-1.5 text-slate-300"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>One special character</li>
                    </ul>
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-2">Confirm
                        Password</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="******"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                        <button type="button" id="toggleConfirmPassword"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-500 hover:text-slate-700 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition shadow-sm">
                    Update User
                </button>
            </div>
        </form>
    </div>
    @push('scripts')
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

                // Validation rules regex matching UserFormRequest.php
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
                        li.classList.remove('text-slate-500');
                        li.classList.add('text-green-600');
                        svg.classList.remove('text-slate-300');
                        svg.classList.add('text-green-500');
                    } else {
                        li.classList.remove('text-green-600');
                        li.classList.add('text-slate-500');
                        svg.classList.remove('text-green-500');
                        svg.classList.add('text-slate-300');
                    }
                }

                function setBorderColor(input, isValid, isEmpty) {
                    input.classList.remove('border-slate-300', 'border-red-500', 'border-green-500');

                    if (isEmpty) {
                        input.classList.add('border-slate-300');
                    } else if (isValid) {
                        input.classList.add('border-green-500');
                    } else {
                        input.classList.add('border-red-500');
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
                password.addEventListener('focus', function () {
                    document.getElementById('passwordRules').classList.remove('hidden');
                });
                confirm_password.addEventListener('input', checkConfirmPassword);
            });
        </script>
    @endpush
@endsection