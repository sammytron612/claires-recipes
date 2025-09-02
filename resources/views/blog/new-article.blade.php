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


<script src="https://cdn.tiny.cloud/1/d3utf658spf5n1oft4rjl6x85g568jj7ourhvo2uhs578jt9/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>

    tinymce.init({
      height : "600",
      selector: '#editor',
      plugins: 'template autoresize autolink image fullscreen imagetools emoticons link lists hr paste media table',
      toolbar: 'insert undo redo fullscreen fontsizeselect alignleft aligncenter alignright alignjustify h1 h2 bold italic numlist bullist image link emoticons hr paste table',
      contextmenu: "link image table paste",
      relative_urls : false,
      content_style: 'textarea { padding: 20px; }',
      templates: [
    {title: 'Some title 1', description: 'Some desc 1', content: 'My content'},
    {title: 'Some title 2', description: 'Some desc 2', url: 'development.html'},
  ],
      autoresize_bottom_margin: 50,
      images_upload_handler: function (blobInfo, success, failure) {
           var xhr, formData;
           xhr = new XMLHttpRequest();
           xhr.withCredentials = false;
           xhr.open('POST', '{{ route("image.upload") }}');
           var token = '{{ csrf_token() }}';
           xhr.setRequestHeader("X-CSRF-Token", token);
           xhr.onload = function() {
               var json;
               if (xhr.status != 200) {
                   failure('HTTP Error: ' + xhr.status);
                   return;
               }
               json = JSON.parse(xhr.responseText);
               if (!json || typeof json.location != 'string') {
                   failure('Invalid JSON: ' + xhr.responseText);
                   return;
               }
                var image = $("#images").val()
               image += (json.location);
               image += "~";
               $('#images').val(image)
               success(json.location);
           };
           formData = new FormData();
           formData.append('file', blobInfo.blob(), blobInfo.filename());
           xhr.send(formData);
       }
    });
 
 
</script>

    


@endsection