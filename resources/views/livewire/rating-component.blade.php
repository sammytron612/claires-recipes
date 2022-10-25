<div>
    @if($rating)
        @for ($i=0; $i<= $rating -1  ;$i++)
            <span><i class="gold-star fa fa-star fa-m"></i></span>
        @endfor
        @for ($i=0; $i<= (4 - $rating) ;$i++)
            <span><i class="fa fa-star fa-m"></i></span>
        @endfor
        @else
            <div class="text-teal">No ratings</div>
    @endif
</div>
