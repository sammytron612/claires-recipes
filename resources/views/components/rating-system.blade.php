<div class="py-2">
    @if($rating)
        @for ($i=0; $i<= $rating -1  ;$i++)
            <span><i class="gold-star fa fa-star fa-sm"></i></span>
        @endfor
        @for ($i=0; $i<= (4 - $rating) ;$i++)
            <span><i class="fa fa-star fa-sm"></i></span>
        @endfor
    @else
        <div class="h6 text-teal"><small>No ratings</small></div>
    @endif
</div>
