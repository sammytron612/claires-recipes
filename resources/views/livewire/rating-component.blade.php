<div class="flex items-center">
    @if($rating)
        @for ($i=0; $i<= $rating -1  ;$i++)
            <span><i class="text-yellow-400 fa fa-star"></i></span>
        @endfor
        @for ($i=0; $i<= (4 - $rating) ;$i++)
            <span><i class="text-gray-300 fa fa-star"></i></span>
        @endfor
    @else
        <div class="text-teal-600">No ratings</div>
    @endif
</div>
