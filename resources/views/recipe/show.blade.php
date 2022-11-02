@extends('layouts.app', ['image'=> $recipe->image, 'title' => $recipe->title . ' | Claires Recipes', 'description' => $recipe->description])

@section('content')

<div class="container-fluid">
@include('includes.search')
</div>

<div class="container px-3 bg-white mt-3 pb-5">
    <div class="row align-items-center py-3">
        <div class="col-6 float-left">
            <img class="d-inline avatar ml-2" src="{{ asset('storage/' . $recipe->User->avatar) }}">
            <span class="weight700 ml-2 weight-900 text-teal">By {{ $recipe->User->name }}</span>
        </div>

        <div class="col-6 float-right position-relative">
                <div style="right:0" class="position-absolute">
                    @if($recipe->attachment)
                        @livewire('download-recipe',['recipe' => $recipe->id])
                    @else
                    <div onclick="CreatePDFfromHTML()" class="my-tab shadow border  btn py-1 float-right">
                        <i class="text-info fas fa-save"></i>
                    </div>
                    @endif
                </div>
                @auth
                @livewire('favourite', ['recipe' => $recipe->id])
                @endAuth
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <img class="border recipe-image border-dark w-100" src="{{ asset('storage/'. $recipe->image) }}">
        </div>
        <div class="col-12 col-md-6 mt-4 mt-md-0">
            <h3>{{ $recipe->title }}</h3>
            <div id="stars">
                @livewire('rating-component',['recipe' => $recipe])
            </div>

            <div class="mt-1">
                @livewire('comment-counter',['recipe' => $recipe])
            </div>
            @if($recipe->cooking_time)
            <div class="mt-2">
                <i class="text-primary fa fa-clock"></i><span class="weight700">&nbsp{{ $recipe->cooking_time }}&nbspmins</span>
            </div>
            @endif
            <div class="mt-3 dodgerblue d-flex align-content-round flex-wrap">

                    @foreach($recipe->HashIngredient as $h_ingredient)
                        <a href="{{ route('ingredient', $h_ingredient->ingredients->slug) }}" class="mr-1 text-decoration-none "><i class="fas fa-hashtag"></i>{{ $h_ingredient->ingredients->title }}</a>
                    @endforeach

                    @foreach($recipe->HashCuisine as $h_cuisine)
                        <a href="{{ route('cuisine', $h_cuisine->CuisineTitle->slug) }}" class="mr-1 text-decoration-none "><i class="fas fa-hashtag"></i>{{ $h_cuisine->CuisineTitle->title }}</a>
                    @endforeach

                    @foreach($recipe->HashDiet as $h_diet)
                        <a href="{{ route('diet', $h_diet->DietTitle->slug) }}" class="mr-1 text-decoration-none "><i class="fas fa-hashtag"></i>{{ $h_diet->DietTitle->title }}</a>
                    @endforeach

                    @foreach($recipe->HashCourse as $h_course)
                        <a href="{{ route('course', $h_course->CourseTitle->slug) }}" class="mr-1 text-decoration-none "><i class="fas fa-hashtag"></i>{{ $h_course->CourseTitle->title }}</a>
                    @endforeach

                    @foreach($recipe->HashMethod as $h_method)
                        <a href="{{ route('method', $h_method->MethodTitle->slug) }}" class="mr-1 text-decoration-none "><i class="fas fa-hashtag"></i>{{ $h_method->MethodTitle->title }}</a>
                    @endforeach
            </div>

            <p class="mt-3 font-italic">{{ $recipe->description }}</p>
            <h6><i class="fa fa-lg fa-share-alt" aria-hidden="true"></i><span class="ml-2 weight700 text-teal">Share this</span></h6>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::fullUrl() }}&display=popup" target="_blank"><i style="color:#3b5998" class="fab fa-2x fa-facebook"></i></a>
            <a href="https://twitter.com/intent/tweet?text=Im cooking {{ $recipe->title }}&url={{ Request::fullUrl() }}" target="_blank"><i style="color:dodgerblue" class="fab fa-2x fa-twitter"></i></a>
            <a class="info" target="_blank" data-pin-do="buttonPin" href="https://www.pinterest.com/pin/create/button/?url={{ Request::fullUrl()}}; &media={{ asset('storage/'. $recipe->image) }}&description={{ $recipe->title }}" data-pin-custom="true"><i style="color:crimson" class="fab fa-2x fa-pinterest"></i></i></a>
        </div>
    </div>
    <br>
    <br>
    <hr>
    @livewire('nutrition', ['recipeId' => $recipe->id])
    <hr>

    @isset($recipe->recipeMethod->description)
    <div id="method" class="row p-5">
        <div id="recipe-method" class="col-12">
             <div id="title" class="d-none text-center h2">{{ $recipe->title }}</div>
            {!! $recipe->recipeMethod->description !!}
        </div>
    </div>
    @endisset
    <br>
    <hr>
    <h5 class="my-5 weight700 text-left text-teal">Like this? Then  we are sure you will also like these:</h5>
    <div class="mt-2 row justify-content-start justify-content-md-center flex-wrap">
        @foreach($similarRecipes as $similarRecipe)
            <div class="col-6 col-md-4 col-lg-3 d-flex mt-2 align-items-stretch">
                <a href="{{ route('recipe',[$similarRecipe->id,$similarRecipe->slug]) }}" class="stretched-link"></a>
                <div class="shadow card p-0 col w-50 w-sm-100">
                    <div style="overflow-y:hidden" class="d-flex flex-column h-auto h5 px-2 pt-3">
                        <div class="text-center text-teal">{{ $similarRecipe->title }}</div>
                    </div>
                    <div class="d-none pb-2 h-auto card-body h-100 d-md-block mb-2">
                        <div>{{ $similarRecipe->description }}</div>
                    </div>
                    <img class="my-height mt-1 card-img-bottom w-100" src="{{ asset('storage/'. $similarRecipe->image) }}" alt="Card image cap">
                </div>
            </div>
        @endforeach
    </div>
    <br>
    <hr>
    @livewire('comments',['recipe' => $recipe])
</div>

<script>

function CreatePDFfromHTML() {
    $('#title').addClass('d-block')
    var HTML_Width = $("#method").width();
    var HTML_Height = $("#method").height() * 1.3;
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 1);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($("#method")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) {
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        $('#title').removeClass('d-block')
        pdf.save("{{ $recipe->title }}");

    });
}


document.addEventListener('DOMContentLoaded', function () {


    $(function () {
        $(".txt").focus(function () {
            $('#starRating').removeClass('invisible')
            $('.txt').animate({
                height: '6rem',
                },
               "slow"
            )
        });
    });
});



</script>
@endsection


