@extends('layouts.app')

@section('content')
<div class="container bg-white py-5">

<x-header title="Edit recipe"/>

@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Recipe updated</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
<form class="row" method="post" action="{{ route('admin.recipe-delete', $recipe->id) }}">
    @csrf
    @method('delete')
    <div class="col-9">
    </div>
    <div class="form-group col-3 order-last mt-2 float-right">
        <button id="delete-recipe" type="submit" class="btn btn-danger form-control">Delete</button>
    </div>
</form>
    <form class="clearfix" id="newRecipe" method="post" enctype="multipart/form-data" action="{{ route('admin.recipe-update') }}">
        @csrf
        <div class="row">
            <div class="col-6">
                <label class="weight700">Ingredients</label>
                <select id="ingredientTags"  style="width:100%;"  name="wireIngredients[]" class="js-example-basic-multiple"  multiple="multiple">
                    @foreach($ingredients as $ingredient)
                        @if(count($hashIngredients))
                            @foreach($hashIngredients as $i)
                                @if($ingredient->id == $i->ingredient)
                                    <option selected value="{{ $ingredient->id }}">{{ $ingredient->title }}</option>
                                @else
                                    <option value="{{ $ingredient->id }}">{{ $ingredient->title }}</option>
                                @endif
                            @endforeach
                        @else
                            <option value="{{ $ingredient->id }}">{{ $ingredient->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="col-6">
                <label class="weight700">Cusines</label>
                <select id="cuisineTags"  style="width:100%;" name="wireCuisines[]" class="js-example-basic-multiple"  multiple="multiple">
                    @foreach($cuisines as $cuisine)
                        @if(count($hashCuisines))
                            @foreach($hashCuisines as $c)
                                @if($cuisine->id == $c->cuisine)
                                    <option selected value="{{ $cuisine->id }}">{{ $cuisine->title }}</option>
                                @else
                                    <option value="{{ $cuisine->id }}">{{ $cuisine->title }}</option>
                                @endif
                            @endforeach
                        @else
                            <option value="{{ $cuisine->id }}">{{ $cuisine->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-6">
                <label class="weight700">Diets</label>
                <select id="dietTags" style="width:100%;" name="wireDiets[]" class="js-example-basic-multiple"  multiple="multiple">
                    @foreach($diets as $diet)
                        @if(count($hashDiets))
                            @foreach($hashDiets as $d)
                                @if($diet->id == $d->diet)
                                    <option selected value="{{ $diet->id }}">{{ $diet->title }}</option>
                                @else
                                    <option value="{{ $diet->id }}">{{ $diet->title }}</option>
                                @endif
                            @endforeach
                        @else
                            <option value="{{ $diet->id }}">{{ $diet->title }}</option>
                        @endif
                @endforeach
                </select>
            </div>

            <div class="col-6">
                <label class="weight700">Courses</label>
                <select id="courseTags"  style="width:100%;" name="wireCourses[]" class="js-example-basic-multiple"  multiple="multiple">
                    @foreach($courses as $course)
                        @if(count($hashCourses))
                            @foreach($hashCourses as $c)
                                @if($course->id == $c->course)
                                    <option selected value="{{ $course->id }}">{{ $course->title }}</option>
                                @else
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endif
                            @endforeach
                        @else
                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div  class="row mt-2">
            <div class="col-6">
                <label class="weight700">Methods</label>
                <select id="methodTags" style="width:100%;" name="wireMethods[]" class="js-example-basic-multiple"  multiple="multiple">
                    @foreach($methods as $method)
                        @if(count($hashMethods))
                            @foreach($hashMethods as $m)
                                @if($method->id == $m->method)
                                    <option selected value="{{ $method->id }}">{{ $method->title }}</option>
                                @else
                                    <option value="{{ $method->id }}">{{ $method->title }}</option>
                                @endif
                            @endforeach
                        @else
                            <option value="{{ $method->id }}">{{ $method->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>


        <hr>
        @php $var = $recipe->attachment ? 0 : 1;@endphp

        <div x-data="{ shown: {{ $var }}, attachment: {{ ($var * -1) + 1}} }"  class="row">
            <div class="col-12">
                    <input type="hidden" name="recipeId" value="{{ $recipe->id }}">
                    @php $checked = $var == 1 ? 'checked' : ''; @endphp
                    <input class="custom-checkbox" {{ $checked }} @click="shown = !shown; attachment = !attachment" name="check" type="checkbox"  autocomplete="off">
                    <label class="h5">Manual Recipe</label>

                <div x-show="shown">
                    <textarea name="method" id="editor">@if(!$recipe->attachment) {{ $recipe->recipeMethod->description }} @endif</textarea>
                </div>
                @error('method') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
                <div class="col-12 col-md-6 pt-2 order-2 order-md-1">
                        <label class="weight700">Image</label>
                        <div class="custom-file">
                            <input onchange="preview(this)" name="photo" type="file"  class="custom-file-input @error('photo') border border-danger @enderror w-100"  id="photo">
                            <label class="custom-file-label" for="photo">Choose file</label>
                            @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div x-show="attachment">
                            <label class="mt-2 weight700">Attachment</label>
                            <div class="custom-file">
                                <input  name="attachment" type="file" class="custom-file-input @error('attachment') border border-danger @enderror w-100" id="attachment">
                                <label class="custom-file-label" for="attachment">Choose file</label>
                                @error('attachment') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            @if($recipe->attachment)
                                <label class="text-info">Details attached</label>
                            @endif
                        </div>

                        <div class="mt-2 form-group">
                            <label class="weight700" for="title">Title</label>
                            <input name="title" required value="{{ $recipe->title }}" class="form-control @error('title') border border-danger @enderror w-100" type="text" id="title">
                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="weight700" for="desc">Description</label>
                            <textarea name="description" required class="form-control @error('description') border border-danger @enderror w-100" rows="5" type="text" id="desc">{{ $recipe->description }}</textarea>
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="weight700" for="desc">Cooking time(minutes)</label>
                            <input type="number" required value="{{ $recipe->cooking_time }}" name="cooking_time" class="form-control @error('cooking_time') border border-danger @enderror w-100" id="cooking">
                            @error('cooking_time') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mt-5">
                            <button type="submit" class="btn btn-teal form-control">Save</button>
                        </div>

                </div>
                <div class="d-flex align-items-center h-100 col-12 col-md-6 order-1 order-md-2 p-25">
                    <img id="previewImg" class="img-fluid border" src="{{ asset('storage/' . $recipe->image ) }}" alt="Placeholder">
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

    $('#delete-recipe').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if (confirm('Are you sure?')) {
            // Post the form
            $(e.target).closest('form').submit() // Post the surrounding form
        }
    });


    $('.js-example-basic-multiple').select2({
        tags: true,
        searchInputPlaceholder: 'Search ingredient ...',
        placeholder: "Select a tag",
                    })

    tinymce.init({
        selector: '#editor',
          height: '480',
          plugins: 'lists link',
          menubar: 'insert',
          toolbar: 'numlist bullist undo link'
        });

});

</script>



</div>


@endsection
