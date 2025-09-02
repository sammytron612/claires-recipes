@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-white py-8">

<x-header title="New recipe"/>

@if (session('status'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
    <strong>Recipe added</strong>
    <button type="button" class="float-right text-green-700 hover:text-green-900" onclick="this.parentElement.style.display='none'" aria-label="Close">
      <span>&times;</span>
    </button>
</div>
@endif
    <form id="newRecipe" method="post" enctype="multipart/form-data" action="{{ route('recipe.store') }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Ingredients</label>
                <select id="ingredientTags" style="width:100%;" name="wireIngredients[]" class="js-example-basic-multiple" multiple="multiple">
                    @foreach($ingredients as $ingredient)
                        <option value="{{ $ingredient->id }}">{{ $ingredient->title }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Cuisines</label>
                <select id="cuisineTags" style="width:100%;" name="wireCuisines[]" class="js-example-basic-multiple" multiple="multiple">
                    @foreach($cuisines as $cuisine)
                        <option value="{{ $cuisine->id }}">{{ $cuisine->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Diets</label>
                <select id="dietTags" style="width:100%;" name="wireDiets[]" class="js-example-basic-multiple" multiple="multiple">
                    @foreach($diets as $diet)
                        <option value="{{ $diet->id }}">{{ $diet->title }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Courses</label>
                <select id="courseTags" style="width:100%;" name="wireCourses[]" class="js-example-basic-multiple" multiple="multiple">
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-6">
            <div class="md:w-1/2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Methods</label>
                <select id="methodTags" style="width:100%;" name="wireMethods[]" class="js-example-basic-multiple" multiple="multiple">
                    @foreach($methods as $method)
                        <option value="{{ $method->id }}">{{ $method->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <hr class="my-6 border-gray-200">
        
        <div x-data="{ shown: false }" class="mb-6">
            <div class="mb-4">
                <input class="mr-2" @click="shown = !shown" name="check" type="checkbox" autocomplete="off">
                <label class="text-lg font-medium text-gray-700">Manual Recipe</label>
            </div>

            <div x-show="shown" class="mb-6">
                <textarea name="method" id="editor"></textarea>
            </div>
            @error('method') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white shadow-sm rounded-lg p-6 border border-gray-200 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Image</label>
                        <input onchange="preview(this)" name="photo" type="file" required class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('photo') border-red-500 @enderror" id="photo">
                        @error('photo') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                    <div x-show="!shown">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Attachment</label>
                        <input name="attachment" type="file" class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('attachment') border-red-500 @enderror" id="attachment">
                        @error('attachment') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="title">Title</label>
                        <input name="title" required class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror" type="text" id="title">
                        <input name="title" required class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror" type="text" id="title">
                        @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="desc">Description</label>
                        <textarea name="description" required class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror" rows="5" type="text" id="desc"></textarea>
                        @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="cooking">Cooking time (minutes)</label>
                        <input type="number" required name="cooking_time" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('cooking_time') border-red-500 @enderror" id="cooking">
                        @error('cooking_time') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-medium py-3 px-6 rounded-md transition-colors">Save Recipe</button>
                    </div>
                </div>
                
                <div class="bg-white shadow-sm rounded-lg p-6 border border-gray-200 flex items-center justify-center">
                    <img id="previewImg" class="max-w-full h-auto border border-gray-300 rounded-md shadow-sm" src="/storage/stock.jpg" alt="Recipe Preview">
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
