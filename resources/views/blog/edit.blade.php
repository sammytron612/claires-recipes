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