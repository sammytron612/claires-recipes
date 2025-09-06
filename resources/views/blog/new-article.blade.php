@extends('layouts.app')

@section('content')

    <x-header title="New Article" />

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 bg-white py-8">
        @if(session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                <div class="flex justify-between items-center">
                    <strong>{{ session()->get('message') }}</strong>
                    <button type="button" class="text-green-700 hover:text-green-900 focus:outline-none" onclick="this.parentElement.parentElement.style.display='none'" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
            </div>
        @endif
        
        <form action="{{route('postArticle')}}" method="post" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Title</label>
                <input type="text" name="title" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror" value="{{old('title')}}" id="title" placeholder="Enter article title">
                @error('title')<small class="text-red-600 text-sm block mt-1">{{$message}}</small>@enderror
            </div>

            <div>
                <label for="lead" class="block text-sm font-semibold text-gray-700 mb-2">Lead Image</label>
                <input type="file" name="image" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('image') border-red-500 @enderror" id="lead" accept="image/*">
                @error('image')<small class="text-red-600 text-sm block mt-1">{{$message}}</small>@enderror
            </div>
        
            <div>
                <label for="editor" class="block text-sm font-semibold text-gray-700 mb-2">Article Content</label>
                @error('body')<small class="text-red-600 text-sm block mb-2">{{$message}}</small>@enderror
                <div class="border border-gray-300 rounded-md overflow-hidden">
                    <textarea id="editor" name="body" class="w-full">{{old('body')}}</textarea>
                </div>
            </div>
            
            <div class="pt-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-8 rounded-md transition-colors text-lg">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    Publish Article
                </button>
            </div>
        </form>
    </div>


<script src="https://cdn.tiny.cloud/1/{{ config('services.tinymce.api_key') }}/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        let isInitialized = false;
        let resizeTimer = null;

        function initTinyMCE() {
            if (isInitialized) return;

            const isMobile = window.innerWidth <= 768;

            tinymce.init({
                licence_key: '{{ config('services.tinymce.api_key') }}',
                selector: '#editor',
                height: 400,
                width: '100%',
                resize: true,
                plugins: 'autoresize advlist lists link image fullscreen code table media searchreplace paste wordcount',
                toolbar: isMobile ?
                    'undo redo | bold italic | bullist numlist | link' :
                    'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image table | code fullscreen',
                toolbar_mode: 'sliding',
                menubar: false,
                branding: false,
                autoresize_bottom_margin: 50,
                content_style: 'body { font-family: system-ui, sans-serif; font-size: 14px; line-height: 1.6; margin: 1rem; } img { max-width: 100%; height: auto; }',

                setup: function(editor) {
                    editor.on('init', function() {
                        isInitialized = true;
                        console.log('TinyMCE initialized');

                        // Ensure proper sizing
                        setTimeout(() => {
                            const container = editor.getContainer();
                            if (container) {
                                container.style.width = '100%';
                            }
                        }, 100);
                    });
                },

                images_upload_handler: function (blobInfo, success, failure) {
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', '{{ route("image.upload") }}');
                    xhr.setRequestHeader("X-CSRF-Token", '{{ csrf_token() }}');

                    xhr.onload = function () {
                        if (xhr.status !== 200) {
                            failure('HTTP Error: ' + xhr.status);
                            return;
                        }

                        let json;
                        try {
                            json = JSON.parse(xhr.responseText);
                        } catch(e) {
                            failure('Invalid JSON');
                            return;
                        }

                        if (!json.location) {
                            failure('No location in response');
                            return;
                        }

                        success(json.location);
                    };

                    const formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                    xhr.send(formData);
                }
            });
        }

        function handleResize() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                const editor = tinymce.get('editor');
                if (editor) {
                    // Just repaint, don't destroy
                    editor.execCommand('mceRepaint');

                    // Ensure container width
                    const container = editor.getContainer();
                    if (container) {
                        container.style.width = '100%';
                    }
                }
            }, 250);
        }

        // Initialize when ready
        document.addEventListener('DOMContentLoaded', function() {
            // Wait a bit for layout to settle
            setTimeout(initTinyMCE, 100);
        });

        // Handle resize without destroying
        window.addEventListener('resize', handleResize);

        // Handle visibility changes (for sidebar)
        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) {
                handleResize();
            }
        });
    </script>


    


@endsection