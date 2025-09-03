<div>
    <div id="comments" class="flex items-center mb-4">
        <svg class="w-8 h-8 text-teal-600 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
        </svg>
        <span class="font-bold text-gray-800">{{ count($comments) }} - Comments/Reviews</span>
    </div>
    
    <div class="mt-4 flex items-center bg-gray-50 p-4 rounded-lg">
        <img class="h-16 w-16 object-cover rounded-md border border-gray-200 mr-4" src="{{ asset('storage/'. $recipe->image) }}" alt="{{$recipe->title}}">
        <span class="font-bold text-gray-800">{{ $recipe->title }}</span>
    </div>
    
    @auth
    @livewire('add-comment', ['recipe' => $recipe])
    @endauth
    
    <div class="border-t border-gray-200 my-6"></div>
    
    <div id="comment-div" class="space-y-6">
        @foreach($comments as $comment)
     
        <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
            <h6 class="font-bold text-gray-900 mb-2">{{ $comment->user->name }}</h6>
            <p class="text-gray-700 italic mb-3">{{ $comment->comment }}</p>

            <div class="flex items-center mb-2">
              
                @if($comment->rating)
                
                    <div class="flex items-center">
                        @for ($i = 1; $i <= 5; $i++)
                            @if($i <= $comment->rating)
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endif
                        @endfor
                        <span class="ml-2 text-sm text-gray-600">({{ $comment->rating }}/5)</span>
                    </div>
                @endif
            </div>
            
            <div class="mt-2">
                <small class="text-gray-500 text-sm">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</small>
            </div>
        </div>
        @endforeach
    </div>
</div>
