@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
    <strong>{{ session('status') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

<x-header title="Admin Menu" />

<div class="container bg-white">
    <div class="pt-5 d-flex justify-content-center row row-cols-2 row-cols-lg-3">
        <div class="p-1 d-flex col card m-1 mb-5 shadow">
            <a href="{{ route('admin.new-recipe') }}" class="">
                <div class="card-body">
                    <h5 class="weight700 text-teal text-center">Add a new recipe</h5>
                </div>
            </a>
        </div>

        <div class="p-1 d-flex col card m-1 mb-5 shadow">
            <a href="{{ route('admin.recipe-index') }}" class="">
                <div class="card-body">
                    <h5 class="weight700 text-teal text-center">Edit a  recipe</h5>
                </div>
            </a>
        </div>

        <div class="p-1 d-flex col card m-1 mb-5 shadow">
            <a href="{{ route('blog.new-article') }}" class="">
                <div class="card-body">
                    <h5 class="weight700 text-teal text-center">New Blog Article</h5>
                </div>
            </a>
        </div>

        <div class="p-1 d-flex  col card m-1 mb-5 shadow">
            <a href="{{ route('admin.new-hashtag') }}" class="">
                <div class="card-body">
                    <h5 class="weight700 text-teal text-center">Add a hashtag/Ingredient</h5>
                </div>
            </a>
        </div>
    </div>
</div>



</div>
<script>

/*
$(function(){
$('.dropdown').on('show.bs.dropdown', function(e){
    $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
  });

  // ADD SLIDEUP ANIMATION TO DROPDOWN //
  $('.dropdown').on('hide.bs.dropdown', function(e){
    e.preventDefault();
    $(this).find('.dropdown-menu').first().stop(true, true).slideUp(400, function(){
    	$('.dropdown').removeClass('open');
      	$('.dropdown').find('.dropdown-toggle').attr('aria-expanded','false');
    });

  });
});
*/
</script>
@endsection
