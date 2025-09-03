@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-white py-8">

<x-header title="Edit recipe"/>

@if (session('status'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
    <strong>Recipe updated</strong>
    <button type="button" class="float-right text-green-700 hover:text-green-900" onclick="this.parentElement.style.display='none'">
      <span>&times;</span>
    </button>
</div>
@endif
<form class="flex justify-end mb-4" method="post" action="{{ route('admin.recipe-delete', $recipe->id) }}">
    @csrf
    @method('delete')
    <button id="delete-recipe" type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-6 rounded-md transition-colors">Delete Recipe</button>
</form>
    <form id="newRecipe" method="post" enctype="multipart/form-data" action="{{ route('admin.recipe-update') }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Ingredients</label>
                <select id="ingredientTags" style="width:100%;" name="wireIngredients[]" class="js-example-basic-multiple" multiple="multiple">
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

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Cuisines</label>
                <select id="cuisineTags" style="width:100%;" name="wireCuisines[]" class="js-example-basic-multiple" multiple="multiple">
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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Diets</label>
                <select id="dietTags" style="width:100%;" name="wireDiets[]" class="js-example-basic-multiple" multiple="multiple">
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

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Courses</label>
                <select id="courseTags" style="width:100%;" name="wireCourses[]" class="js-example-basic-multiple" multiple="multiple">
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

        <div class="mb-6">
            <div class="md:w-1/2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Methods</label>
                <select id="methodTags" style="width:100%;" name="wireMethods[]" class="js-example-basic-multiple" multiple="multiple">
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

        <hr class="my-6 border-gray-200">
        @php $var = $recipe->attachment ? 0 : 1;@endphp

        <div x-data="{ shown: {{ $var }}, attachment: {{ ($var * -1) + 1}} }" class="mb-6">
            <div class="w-full">
                    <input type="hidden" name="recipeId" value="{{ $recipe->id }}">
                    @php $checked = $var == 1 ? 'checked' : ''; @endphp
                    <input class="mr-2" {{ $checked }} @click="shown = !shown; attachment = !attachment" name="check" type="checkbox" autocomplete="off">
                    <label class="text-lg font-medium text-gray-700">Manual Recipe</label>

                <div x-show="shown" class="mt-4">
                    <textarea name="method" id="editor">@if(!$recipe->attachment) {{ $recipe->recipeMethod->description }} @endif</textarea>
                </div>
                @error('method') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-6">
                <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Image</label>
                            <input  name="photo" type="file" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('photo') border-red-500 @enderror" id="photo">
                            @error('photo') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <div x-show="attachment">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Attachment</label>
                            <input name="attachment" type="file" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('attachment') border-red-500 @enderror" id="attachment">
                            @error('attachment') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            @if($recipe->attachment)
                                <p class="text-blue-600 text-sm mt-1">Details attached</p>
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2" for="title">Title</label>
                            <input name="title" required value="{{ $recipe->title }}" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror" type="text" id="title">
                            @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2" for="desc">Description</label>
                            <textarea name="description" required class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror" rows="5" type="text" id="desc">{{ $recipe->description }}</textarea>
                            @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2" for="cooking">Cooking time (minutes)</label>
                            <input type="number" required value="{{ $recipe->cooking_time }}" name="cooking_time" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('cooking_time') border-red-500 @enderror" id="cooking">
                            @error('cooking_time') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-medium py-3 px-6 rounded-md transition-colors">Save Recipe</button>
                        </div>
                </div>
                
                <div class="flex items-center justify-center">
                    <img id="previewImg" class="max-w-full h-auto border border-gray-300 rounded-md shadow-sm" src="{{ asset('storage/' . $recipe->image ) }}" alt="Recipe Preview">
                </div>
            </div>
        </div>
        </form>
</div>
       
        <script src="https://cdn.tiny.cloud/1/d3utf658spf5n1oft4rjl6x85g568jj7ourhvo2uhs578jt9/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
       
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
