<div>
    <div id="comments" class="d-flex align-items-center">
        <i class="text-teal fas fa-comment fa-2x mr-2"></i><span class="weight700" >{{ count($comments) }}&nbsp-&nbspComments/Reviews</span>
    </div>
    <div class="mt-3 d-flex align-items-center">
        <img style="height:4rem" class="border mr-2 d-inline" src="{{ asset('storage/'. $recipe->image) }}" alt="{{$recipe->title}}"></span>
        <span class="weight700">{{ $recipe->title }}</span>
    </div>
    @auth
    @livewire('add-comment', ['recipe' => $recipe])
    @endauth
    <hr>
    <div id="comment-div" class="mt-3">
        @foreach($comments as $comment)
        <h6 style="font-weight:700">{{ $comment->user->name }}</h6>
        <p class="font-italic">{{ $comment->comment }}</p>

        <div>
            @if($comment->rating)
                @for ($i=0; $i<= $comment->rating -1  ;$i++)
                    <span><i class="gold-star fa fa-star fa-m"></i></span>
                @endfor
                @for ($i=0; $i<= (4 - $comment->rating) ;$i++)
                    <span><i class="fa fa-star fa-m"></i></span>
                @endfor
            @endif
        </div>
        <div class="mt-1">
        <small class="text-muted"> {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }} </small>
        </div>
        <hr>
        @endforeach
    </div>
</div>
