@extends('layouts.app')

@section('content')
<div class="container bg-white py-5">

<x-header title="New recipe"/>

@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Recipe added</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
    <form id="newRecipe" method="post" enctype="multipart/form-data" action="{{ route('recipe.store') }}">
        @csrf
        <div class="row">
            <div class="col-6">
                <label class="weight700">Ingredients</label>
                <select id="ingredientTags"  style="width:100%;" name="wireIngredients[]" class="js-example-basic-multiple"  multiple="multiple">
                    @foreach($ingredients as $ingredient)
                        <option value="{{ $ingredient->id }}">{{ $ingredient->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-6">
                <label class="weight700">Cusines</label>
                <select id="cuisineTags"  style="width:100%;" name="wireCuisines[]" class="js-example-basic-multiple"  multiple="multiple">
                    @foreach($cuisines as $cuisine)
                        <option value="{{ $cuisine->id }}">{{ $cuisine->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-6">
                <label class="weight700">Diets</label>
                <select id="dietTags" style="width:100%;" name="wireDiets[]" class="js-example-basic-multiple"  multiple="multiple">
                    @foreach($diets as $diet)
                        <option value="{{ $diet->id }}">{{ $diet->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-6">
                <label class="weight700">Courses</label>
                <select id="courseTags"  style="width:100%;" name="wireCourses[]" class="js-example-basic-multiple"  multiple="multiple">
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div  class="row mt-2">
            <div class="col-6">
                <label class="weight700">Methods</label>
                <select id="methodTags" style="width:100%;" name="wireMethods[]" class="js-example-basic-multiple"  multiple="multiple">
                    @foreach($methods as $method)
                        <option value="{{ $method->id }}">{{ $method->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <hr>
        <div class="row">
            <div x-data="{ shown: false }" class="col-12">

                    <input class="custom-checkbox" @click="shown = !shown" name="check" type="checkbox"  autocomplete="off">
                    <label class="h5">Manual Recipe</label>

                <div x-show="shown">
                    <textarea name="method" id="editor"></textarea>
                </div>
                @error('method') <span class="text-danger">{{ $message }}</span> @enderror

                <div class="shadow col-12 col-md-6 pt-2 order-2 order-md-1">
                        <label class="weight700">Image</label>
                        <div class="custom-file">
                            <input onchange="preview(this)" name="photo" type="file" required class="custom-file-input @error('photo') border border-danger @enderror w-100"  id="photo">
                            <label class="custom-file-label" for="photo">Choose file</label>
                            @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div x-show="!shown">
                            <label class="mt-2 weight700">Attachment</label>
                            <div class="custom-file">
                                <input  name="attachment" type="file" class="custom-file-input @error('attachment') border border-danger @enderror w-100" id="attachment">
                                <label class="custom-file-label" for="attachment">Choose file</label>
                                @error('attachment') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mt-2 form-group">
                            <label class="weight700" for="title">Title</label>
                            <input name="title" required class="form-control @error('title') border border-danger @enderror w-100" type="text" id="title">
                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="weight700" for="desc">Description</label>
                            <textarea name="description" required class="form-control @error('description') border border-danger @enderror w-100" rows="5" type="text" id="desc"></textarea>
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="weight700" for="desc">Cooking time(minutes)</label>
                            <input type="number" required name="cooking_time" class="form-control @error('cooking_time') border border-danger @enderror w-100" id="cooking">
                            @error('cooking_time') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mt-5">
                            <button type="submit" class="btn btn-teal form-control">Save</button>
                        </div>
                </div>
                <div class="shadow h-auto col-12 col-md-6 order-1 order-md-2 p-25">
                    <img id="previewImg" class="img-fluid" src="/storage/stock.jpg" alt="Placeholder">
                </div>


            </div>
            </div>
        </form>
        </div>
        @push('scripts')
        <script src="https://cdn.tiny.cloud/1/d3utf658spf5n1oft4rjl6x85g568jj7ourhvo2uhs578jt9/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        @endpush
<script>

function preview(input){
        var file = $('#photo').get(0).files[0];

        if(file){
            var reader = new FileReader();

            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
    }

document.addEventListener('DOMContentLoaded', function () {


    $('.js-example-basic-multiple').select2({
        tags: true,
        placeholder: "Select a tag",
                    })

    tinymce.init({
          selector: '#editor',
          height: '480',
          plugins: 'lists link',
          menubar: 'insert',
          toolbar: 'numlist bullist undo link',
          default_link_target: '_blank',
          link_list: [
        {title: 'link', value: '#'}
    ]
        });

});

</script>



</div>


@endsection
