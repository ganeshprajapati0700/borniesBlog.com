@extends('admin.layouts.app')
@section('page-title', 'Create Post')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--multiple {
            min-height: 42px;
            border: 1px solid #cbd5e1;
            border-radius: 0.5rem;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 0.25rem;
            padding: 2px 8px;
            color: #334155;
            margin-top: 6px;
        }
    </style>

    <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Posts', 'url' => route('posts.index')],
            ['label' => 'Create Post']
        ]">
    </x-breadcrumb>
    <x-page-header title="Create New Post" subtitle="Add a new post to organize your posts" buttonLabel="Back to Posts"
        buttonUrl="{{ route('posts.index') }}" />
    @if ($errors->any())
        <div class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- header end here --}}
    {{-- form start here --}}
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Authors -->
                <x-select-field label="Author" name="user_id" :options="['' => 'Select Author'] + $authors->pluck('name', 'id')->toArray()" value="{{ old('user_id') }}" required />

                <!-- Category -->
                <x-select-field label="Category" name="category_id" :options="['' => 'Select Category'] + $categories->pluck('name', 'id')->toArray()" value="{{ old('category_id') }}" required />

                <!-- Subcategory (AJAX populated) -->
                <div>
                    <label for="sub_category_id" class="block text-sm font-medium text-slate-700 mb-2">Sub Category</label>
                    <select name="sub_category_id" id="sub_category_id"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                        <option value="">Select Subcategory</option>
                    </select>
                    @error('sub_category_id')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tags (Multiple) -->
                <div>
                    <label for="tags" class="block text-sm font-medium text-slate-700 mb-2">Tags</label>
                    <select name="tags[]" id="tags" multiple
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors h-32">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    <p class="text-xs text-slate-500 mt-1">Hold Ctrl (Windows) or Command (Mac) to select multiple</p>
                    @error('tags')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Type -->
                <x-select-field label="Type" name="type" :options="['' => 'Select Type', 'news' => 'News', 'article' => 'Article', 'interview' => 'Interview']" value="{{ old('type') }}" required />
            </div>

            <x-input-field label="Title" name="title" placeholder="Enter Title" value="{{ old('title') }}" required />

            <div>
                <label for="shortDesc" class="block text-sm font-medium text-slate-700 mb-2">Short Description
                    (Subtitle)</label>
                <textarea name="shortDesc" id="shortDesc" rows="3"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors"
                    placeholder="Enter short description">{{ old('shortDesc') }}</textarea>
                <div class="flex justify-between mt-1">
                    <p class="text-xs text-slate-500">Brief summary of your post.</p>
                    <p id="shortDesc_count" class="text-xs font-medium text-slate-500">0 / 225 characters</p>
                </div>
                @error('shortDesc')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-slate-700 mb-2">Description <span
                        class="text-xs text-slate-500 font-normal">(Max 3000 words)</span></label>
                <textarea name="description" id="description" rows="5"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="image_path" class="block text-sm font-medium text-slate-700 mb-2">Cover Image</label>

                <div id="image_preview_container" class="mb-4" style="display: none;">
                    <img id="image_preview" src="" alt="Cover Image Preview"
                        class="h-48 w-auto rounded-lg shadow-sm border border-slate-200" style="display: none;">
                    <p id="image_info" class="text-xs text-slate-500 mt-2 font-mono"></p>
                </div>

                <input type="file" name="image_path" id="image_path" accept="image/*"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                @error('image_path')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <x-select-field label="Status" name="status" :options="[0 => 'Draft', 1 => 'Published']"
                value="{{ old('status', 'draft') }}" required />

            <!-- SEO & Social Media Settings (Collapsible) -->
            <div class="border border-slate-200 rounded-lg overflow-hidden shadow-sm bg-slate-50">
                <div class="px-4 py-3 bg-slate-100 border-b border-slate-200 flex justify-between items-center cursor-pointer" onclick="document.getElementById('seo-section').classList.toggle('hidden')">
                    <h4 class="text-sm font-bold text-slate-700 uppercase tracking-wider">SEO & Social Media Settings</h4>
                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </div>
                <div id="seo-section" class="p-4 space-y-6 hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-input-field label="Meta Title" name="meta_title" placeholder="SEO Title" value="{{ old('meta_title') }}" />
                        <x-input-field label="Meta Keywords" name="meta_keywords" placeholder="Keywords (comma separated)" value="{{ old('meta_keywords') }}" />
                    </div>
                    <div>
                        <label for="meta_description" class="block text-sm font-medium text-slate-700 mb-2">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="2" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">{{ old('meta_description') }}</textarea>
                    </div>
                    <hr class="border-slate-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-input-field label="OG Title" name="og_title" placeholder="Open Graph Title" value="{{ old('og_title') }}" />
                        <x-input-field label="OG Image URL" name="og_image" placeholder="Social share image URL" value="{{ old('og_image') }}" />
                    </div>
                    <div>
                        <label for="og_description" class="block text-sm font-medium text-slate-700 mb-2">OG Description</label>
                        <textarea name="og_description" id="og_description" rows="2" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">{{ old('og_description') }}</textarea>
                    </div>
                </div>
            </div>


            <div>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition shadow-sm">
                    Create Post
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Initialize Select2
                $('#tags').select2({
                    placeholder: "Select tags...",
                    allowClear: true,
                    width: '100%'
                });

                // Initialize TinyMCE
                tinymce.init({
                    selector: '#description',
                    height: 500,
                    menubar: false,
                    plugins: [
                        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                        'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
                    ],
                    toolbar: 'undo redo | blocks | ' +
                        'bold italic forecolor | alignleft aligncenter ' +
                        'alignright alignjustify | bullist numlist outdent indent | ' +
                        'removeformat | image | help',
                    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
                    setup: function (editor) {
                        const maxWords = 3000;
                        editor.on('keydown', function (e) {
                            // allowed keys: backspace, delete, arrows
                            const allowedKeys = [8, 46, 37, 38, 39, 40];
                            if (allowedKeys.includes(e.keyCode)) return;

                            const wordCount = editor.plugins.wordcount ? editor.plugins.wordcount.body.getWordCount() : 0;
                            if (wordCount >= maxWords) {
                                e.preventDefault();
                                e.stopPropagation();
                                return false;
                            }
                        });

                        editor.on('paste', function (e) {
                            const wordCount = editor.plugins.wordcount ? editor.plugins.wordcount.body.getWordCount() : 0;
                            if (wordCount >= maxWords) {
                                e.preventDefault();
                            }
                        });
                    },
                    file_picker_callback: function (cb, value, meta) {
                        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                        var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                        var cmsURL = '/admin/laravel-filemanager?editor=' + meta.fieldname;
                        if (meta.filetype == 'image') {
                            cmsURL = cmsURL + "&type=Images";
                        } else {
                            cmsURL = cmsURL + "&type=Files";
                        }

                        tinyMCE.activeEditor.windowManager.openUrl({
                            url: cmsURL,
                            title: 'Filemanager',
                            width: x * 0.8,
                            height: y * 0.8,
                            resizable: "yes",
                            close_previous: "no",
                            onMessage: (api, message) => {
                                cb(message.content);
                            }
                        });
                    }
                });

                // Image Preview Logic
                const imageInput = document.getElementById('image_path');
                const previewContainer = document.getElementById('image_preview_container');
                const previewImage = document.getElementById('image_preview');
                const imageInfo = document.getElementById('image_info');

                if (imageInput) {
                    imageInput.addEventListener('change', function () {
                        const file = this.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                previewImage.src = e.target.result;
                                previewImage.style.display = 'block';
                                previewContainer.style.display = 'block';

                                // Show file info
                                const sizeKB = (file.size / 1024).toFixed(2);
                                const date = new Date(file.lastModified);
                                imageInfo.textContent = `Name: ${file.name} | Size: ${sizeKB} KB | Created: ${date.toLocaleString()}`;
                            }
                            reader.readAsDataURL(file);
                        } else {
                            previewImage.src = '';
                            previewImage.style.display = 'none';
                            previewContainer.style.display = 'none';
                            imageInfo.textContent = '';
                        }
                    });
                }

                // Short Description Character Count Logic
                const shortDescInput = document.getElementById('shortDesc');
                const shortDescCount = document.getElementById('shortDesc_count');
                const maxChars = 225;

                if (shortDescInput) {
                    shortDescInput.addEventListener('input', function () {
                        let text = this.value;
                        let charCount = text.length;

                        if (charCount > maxChars) {
                            // Truncate to maxChars
                            this.value = text.substring(0, maxChars);
                            charCount = maxChars;
                        }

                        shortDescCount.textContent = `${charCount} / ${maxChars} characters`;
                        if (charCount >= maxChars) {
                            shortDescCount.classList.remove('text-slate-500');
                            shortDescCount.classList.add('text-red-500');
                        } else {
                            shortDescCount.classList.remove('text-red-500');
                            shortDescCount.classList.add('text-slate-500');
                        }
                    });

                    // Trigger once on load for old data
                    shortDescInput.dispatchEvent(new Event('input'));
                }

                // Subcategory AJAX logic
                const categorySelect = document.getElementById('category_id');
                const subCategorySelect = document.getElementById('sub_category_id');

                if (categorySelect) {
                    categorySelect.addEventListener('change', function () {
                        const categoryId = this.value;

                        // Clear existing options
                        subCategorySelect.innerHTML = '<option value="">Select Subcategory</option>';

                        if (categoryId) {
                            fetch(`{{ route('subcategories.by_category') }}?category_id=${categoryId}`)
                                .then(response => response.json())
                                .then(data => {
                                    data.forEach(sub => {
                                        const option = document.createElement('option');
                                        option.value = sub.id;
                                        option.textContent = sub.name;
                                        subCategorySelect.appendChild(option);
                                    });
                                })
                                .catch(error => console.error('Error fetching subcategories:', error));
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection