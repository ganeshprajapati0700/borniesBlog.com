@extends('admin.layouts.app')
@section('page-title', 'Site Settings')
@section('content')
    @php
        use App\Models\Setting;
    @endphp
    <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Settings']
        ]">
    </x-breadcrumb>
    <x-page-header title="System Settings" subtitle="Manage your website configuration, SEO, and email settings" />

    @if (session('success'))
        <div
            class="mb-6 p-4 rounded-xl flex items-center gap-3 shadow-sm animate-slide-in text-sm bg-emerald-50 text-emerald-800 border border-emerald-200">
            <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
            <div class="flex flex-col md:flex-row min-h-[500px]">
                <!-- Sidebar Tabs -->
                <div class="w-full md:w-64 bg-slate-50 border-r border-slate-100 p-4 space-y-2">
                    <button type="button" onclick="showTab('site')"
                        class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 bg-white text-indigo-600 shadow-sm border border-slate-200 active"
                        id="btn-site">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Site Identity
                    </button>
                    <button type="button" onclick="showTab('seo')"
                        class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-500 hover:bg-white hover:text-indigo-600 transition-all duration-200"
                        id="btn-seo">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        SEO Config
                    </button>
                    <button type="button" onclick="showTab('email')"
                        class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-500 hover:bg-white hover:text-indigo-600 transition-all duration-200"
                        id="btn-email">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Email SMTP
                    </button>
                </div>

                <!-- Content Area -->
                <div class="flex-1 p-8">
                    <!-- Site Identity Tab -->
                    <div id="tab-site" class="tab-content space-y-6 animate-fade-in">
                        <h3 class="text-lg font-bold text-slate-800 mb-4">Site Identity</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-input-field label="Site Name" name="site_name"
                                value="{{ Setting::get('site_name', 'Site Name') }}" />
                            <x-input-field label="Site Description" name="site_description"
                                value="{{ Setting::get('site_description') }}" />
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-input-field label="Site Logo (URL)" name="site_logo"
                                value="{{ Setting::get('site_logo', asset('img/borniesLogo.webp')) }}" />
                            <x-input-field label="Site Favicon (URL)" name="site_favicon"
                                value="{{ Setting::get('site_favicon', asset('img/borniesLogo.webp')) }}" />
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-input-field label="Support Email" name="support_email"
                                value="{{ Setting::get('support_email') }}" />
                        </div>

                        <div class="p-4 bg-amber-50 rounded-xl border border-amber-100">
                            <div class="flex items-center gap-3 mb-2">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <span class="text-sm font-bold text-amber-900">Maintenance Mode</span>
                            </div>
                            <select name="maintenance_mode"
                                class="w-full px-4 py-2 bg-white border border-amber-200 rounded-lg text-sm focus:ring-2 focus:ring-amber-500 outline-none">
                                <option value="0" {{ Setting::get('maintenance_mode') == 0 ? 'selected' : '' }}>Off (Live)
                                </option>
                                <option value="1" {{ Setting::get('maintenance_mode') == 1 ? 'selected' : '' }}>On (Under
                                    Maintenance)</option>
                            </select>
                        </div>
                    </div>

                    <!-- SEO Config Tab -->
                    <div id="tab-seo" class="tab-content space-y-6 hidden animate-fade-in">
                        <h3 class="text-lg font-bold text-slate-800 mb-4">SEO Configuration</h3>
                        <div class="space-y-4">
                            <x-input-field label="Default Meta Title" name="default_meta_title"
                                value="{{ Setting::get('default_meta_title') }}" />
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Default Meta
                                    Description</label>
                                <textarea name="default_meta_description" rows="3"
                                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">{{ Setting::get('default_meta_description') }}</textarea>
                            </div>
                            <x-input-field label="Default Meta Keywords" name="default_meta_keywords"
                                value="{{ Setting::get('default_meta_keywords') }}" />
                        </div>
                    </div>

                    <!-- Email SMTP Tab -->
                    <div id="tab-email" class="tab-content space-y-6 hidden animate-fade-in">
                        <h3 class="text-lg font-bold text-slate-800 mb-4">Email (SMTP) Settings</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-input-field label="Mail Host" name="mail_host"
                                value="{{ Setting::get('mail_host', config('mail.mailers.smtp.host')) }}" />
                            <x-input-field label="Mail Port" name="mail_port"
                                value="{{ Setting::get('mail_port', config('mail.mailers.smtp.port')) }}" />
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-input-field label="Mail Username" name="mail_username"
                                value="{{ Setting::get('mail_username', config('mail.mailers.smtp.username')) }}" />
                            <x-input-field label="Mail Encryption" name="mail_encryption"
                                value="{{ Setting::get('mail_encryption', config('mail.mailers.smtp.encryption')) }}" />
                        </div>
                        <x-input-field label="Mail From Address" name="mail_from_address"
                            value="{{ Setting::get('mail_from_address', config('mail.from.address')) }}" />
                    </div>
                </div>
            </div>

            <!-- Footer Buttons -->
            <div class="bg-slate-50 px-8 py-4 border-t border-slate-100 flex justify-end gap-3">
                <button type="reset"
                    class="px-6 py-2.5 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-100 transition-all duration-200">Reset</button>
                <button type="submit"
                    class="px-6 py-2.5 rounded-xl text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition-all duration-200">Save
                    Changes</button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            function showTab(tabId) {
                // Hide all content
                document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
                // Show selected content
                document.getElementById('tab-' + tabId).classList.remove('hidden');

                // Update buttons
                document.querySelectorAll('.tab-btn').forEach(btn => {
                    btn.classList.remove('bg-white', 'text-indigo-600', 'shadow-sm', 'border-slate-200');
                    btn.classList.add('text-slate-500');
                });

                const activeBtn = document.getElementById('btn-' + tabId);
                activeBtn.classList.add('bg-white', 'text-indigo-600', 'shadow-sm', 'border-slate-200');
                activeBtn.classList.remove('text-slate-500');
            }
        </script>
    @endpush
@endsection