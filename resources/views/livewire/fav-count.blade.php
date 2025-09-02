<div>
    <a class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors" href="{{ route('profile.favourites') }}" aria-label="My Favourites">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
        </svg>
        <span>My Favourites</span>
        @if($favCounter > 0)
            <span class="ml-auto bg-orange-100 text-orange-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $favCounter }}</span>
        @endif
    </a>
</div>
