@extends('layouts.app')

@section('content')

    <x-header title="Edit Post" />

    <div class="container bg-white p-2">
        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('message') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <form action="{{route('updateArticle', $post->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row form-group px-5">
                <label for="Title"><h5 class="font-weight-bold">Title</h5></label>
                <input type="text" name="title" class="form-control" value="{{$post->title}}" id="title">
                @error('title')<small class="text-danger">{{$message}}</small>@enderror
            </div>

            <div x-data="{image:true}" class="mt-3 row row-cols-1 row-cols-md-2 form-group px-5">
                <div x-show="!image" class="col">
                    <label for="lead"><h5 class="font-weight-bold">Lead Image</h5></label>
                    <input type="file" name="image" class="form-control" id="lead">
                    @error('image')<small class="text-danger">{{$message}}</small>@enderror
                </div>
                <div x-show="image" class="col mt-3 ">
                    <label for="lead"><h5 class="font-weight-bold">Lead Image</h5></label>
                    <img class="w-100" src="{{$post->main_image}}"/>
                    <button type="button" @click="image = false" class="mt-3 btn btn-sm btn-danger">Replace Image</button>
                </div>
            </div>
        
            <div class="px-5">
                @error('body')<small class="text-danger">{{$message}}</small>@enderror
                <textarea id="editor"  name="body">
                    {{$post->postBody->body}}
                </textarea>
            </div>

            <div class="px-5">
                <button type="submit" class="btn btn-primary btn-lg mb-3 mt-5">Publish</button>
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
                relative_urls: false,
                remove_script_host: false,
                document_base_url: '{{ url('/') }}',
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