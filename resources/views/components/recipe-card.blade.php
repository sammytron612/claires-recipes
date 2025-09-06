@props(['recipe'])

<div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
    <div class="relative">
        <a href="{{ route('recipe', ['id' => $recipe->id, 'slug' => $recipe->slug]) }}" wire:navigate>
        <img class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" 
             src="{{ asset('storage/' . $recipe->image) }}" 
             alt="{{ $recipe->title }} - {{ Str::limit($recipe->description, 50) }}"
             loading="lazy">
        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
        
        <!-- Rating Badge -->
        @if($recipe->rating && $recipe->rating > 0)
            <div class="absolute top-3 right-3 bg-gradient-to-r from-yellow-400 to-orange-400 text-white px-2 py-1 rounded-full text-xs font-bold shadow-lg flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                {{ number_format($recipe->rating, 1) }}
            </div>
        @endif
    </div>
    <div class="p-4">
        <h3 class="font-semibold text-lg text-gray-800 mb-2 group-hover:text-teal-600 transition-colors duration-200">
            {{ $recipe->title }}
        </h3>
        <p class="text-gray-600 text-sm mb-3 line-clamp-2">
            {{ Str::limit($recipe->description, 80) }}
        </p>
        
        <!-- Author Info -->
        <div class="flex items-center mb-3 text-sm text-gray-500">
            <span>by {{ $recipe->user ? $recipe->user->name : 'Claire' }}</span>
        </div>
        
        <!-- Rating and Reviews -->
        <div class="flex items-center justify-between mb-3">
            <div class="flex items-center">
                @if($recipe->rating && $recipe->rating > 0)
                    <div class="flex items-center">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 {{ $i <= $recipe->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                        <span class="ml-1 text-sm text-gray-600">{{ number_format($recipe->rating, 1) }}</span>
                    </div>
                @else
                    <div class="flex items-center">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                        <span class="ml-1 text-sm text-gray-500">No rating</span>
                    </div>
                @endif
            </div>
            
            <!-- Review Count -->
            @php
                $reviewCount = $recipe->commentRecipe ? $recipe->commentRecipe->count() : 0;
            @endphp
            @if($reviewCount > 0)
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    {{ $reviewCount }} {{ $reviewCount == 1 ? 'review' : 'reviews' }}
                </div>
            @else
                <div class="flex items-center text-sm text-gray-400">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    No reviews yet
                </div>
            @endif
        </div>
        @auth
        <div>
            <livewire:favourite :recipe="$recipe->id"/>
        </div>
        @endauth
    </a>
    </div>
</div>
