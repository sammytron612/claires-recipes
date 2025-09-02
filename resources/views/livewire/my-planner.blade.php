<div class="max-w-7xl mx-auto">
    <style>
                          @php
                            $slotNames = [1 => 'Breakfast', 2 => 'Lunch', 3 => 'Dinner'];
                            $slotColors = [1 => 'bg-green-500', 2 => 'bg-blue-500', 3 => 'bg-purple-500'];
                        @endphp .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
    <!-- Header Section -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">My Weekly Meal Planner</h1>
                <p class="text-gray-600 mt-1">Plan your meals for the week ahead</p>
            </div>
        </div>
    </div>

    <!-- Weekly Calendar Cards with Recipes -->
    <div class="mb-6" wire:key="weekly-cards">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-7 gap-4">
            @foreach($weeklySchedule as $dayNumber => $dayData)
                @php
                    // Define colors for each day
                    $dayColors = [
                        1 => 'from-blue-500 to-blue-600',      // Monday - Blue
                        2 => 'from-green-500 to-green-600',    // Tuesday - Green  
                        3 => 'from-purple-500 to-purple-600',  // Wednesday - Purple
                        4 => 'from-orange-500 to-orange-600',  // Thursday - Orange
                        5 => 'from-red-500 to-red-600',        // Friday - Red
                        6 => 'from-indigo-500 to-indigo-600',  // Saturday - Indigo
                        7 => 'from-pink-500 to-pink-600'       // Sunday - Pink
                    ];
                    $dayColor = $dayColors[$dayNumber] ?? 'from-gray-500 to-gray-600';
                @endphp
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden" wire:key="day-card-{{ $dayNumber }}">
                    <!-- Day Header -->
                    <div class="bg-gradient-to-r {{ $dayColor }} text-white px-4 py-3">
                        <h3 class="font-semibold text-center text-sm">{{ $dayData['name'] }}</h3>
                    </div>

                    <!-- Meal Slots -->
                    <div class="p-4 space-y-2">
                        @php
                            $slotNames = [1 => 'Breakfast', 2 => 'Lunch', 3 => 'Dinner'];
                            $slotColors = [1 => 'bg-green-500', 2 => 'bg-blue-500', 3 => 'bg-purple-500'];
                            $slotEmojis = [1 => '�', 2 => '🥪', 3 => '�️'];
                        @endphp
                        
                        @foreach([1, 2, 3] as $slotNumber)
                            @php
                                $recipe = $this->getRecipeForSlot($dayNumber, $slotNumber);
                                // Define hover colors to match day theme
                                $hoverColors = [
                                    1 => 'hover:border-blue-400 hover:bg-blue-50',      // Monday
                                    2 => 'hover:border-green-400 hover:bg-green-50',    // Tuesday
                                    3 => 'hover:border-purple-400 hover:bg-purple-50',  // Wednesday
                                    4 => 'hover:border-orange-400 hover:bg-orange-50',  // Thursday
                                    5 => 'hover:border-red-400 hover:bg-red-50',        // Friday
                                    6 => 'hover:border-indigo-400 hover:bg-indigo-50',  // Saturday
                                    7 => 'hover:border-pink-400 hover:bg-pink-50'       // Sunday
                                ];
                                $hoverColor = $hoverColors[$dayNumber] ?? 'hover:border-gray-400 hover:bg-gray-50';
                            @endphp
                            
                            <div class="w-full min-h-[60px] p-2 text-sm rounded-lg border-2 border-dashed transition-all duration-200 {{ $recipe ? 'border-gray-300 ' . $hoverColor : 'border-gray-300 hover:border-gray-400' }}" wire:key="slot-{{ $dayNumber }}-{{ $slotNumber }}">
                                @if($recipe)
                                    <!-- Clickable Recipe Display -->
                                    <a href="{{ route('recipe', ['id' => $recipe['id'], 'slug' => $recipe['slug']]) }}" 
                                       class="block w-full h-full rounded transition-colors group cursor-pointer"
                                       title="Click to view {{ $recipe['title'] }}">
                                        <div class="flex items-start space-x-2">
                                            @if($recipe['image'])
                                                <img src="{{ asset('storage/' . $recipe['image']) }}" 
                                                     alt="{{ $recipe['title'] }}"
                                                     class="w-8 h-8 rounded object-cover flex-shrink-0 group-hover:opacity-90 transition-opacity"
                                                     onerror="this.style.display='none'">
                                            @endif
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center justify-between mb-1">
                                                    <div class="flex items-center space-x-1">
                                                        <span class="text-xs font-medium text-gray-600">{{ $slotNames[$slotNumber] }}</span>
                                                    </div>
                                                    <!-- Click indicator -->
                                                    @php
                                                        $arrowColors = [
                                                            1 => 'group-hover:text-blue-500',   // Monday
                                                            2 => 'group-hover:text-green-500',  // Tuesday
                                                            3 => 'group-hover:text-purple-500', // Wednesday
                                                            4 => 'group-hover:text-orange-500', // Thursday
                                                            5 => 'group-hover:text-red-500',    // Friday
                                                            6 => 'group-hover:text-indigo-500', // Saturday
                                                            7 => 'group-hover:text-pink-500'    // Sunday
                                                        ];
                                                        $arrowColor = $arrowColors[$dayNumber] ?? 'group-hover:text-blue-500';
                                                    @endphp
                                                    <svg class="w-3 h-3 text-gray-400 {{ $arrowColor }} transition-colors opacity-0 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </div>
                                                @php
                                                    $titleColors = [
                                                        1 => 'group-hover:text-blue-600',   // Monday
                                                        2 => 'group-hover:text-green-600',  // Tuesday
                                                        3 => 'group-hover:text-purple-600', // Wednesday
                                                        4 => 'group-hover:text-orange-600', // Thursday
                                                        5 => 'group-hover:text-red-600',    // Friday
                                                        6 => 'group-hover:text-indigo-600', // Saturday
                                                        7 => 'group-hover:text-pink-600'    // Sunday
                                                    ];
                                                    $titleColor = $titleColors[$dayNumber] ?? 'group-hover:text-blue-600';
                                                @endphp
                                                <div class="text-xs font-semibold text-gray-900 leading-tight line-clamp-2 {{ $titleColor }} transition-colors">
                                                    {{ $recipe['title'] }}
                                                </div>
                                                @if($recipe['cooking_time'])
                                                    <div class="text-xs text-gray-500 mt-1">
                                                        {{ $recipe['cooking_time'] }} min
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                @else
                                    <!-- Empty Slot -->
                                    <div class="flex items-center justify-center h-full text-gray-400">
                                        <div class="text-center">
                                            <div class="text-xs font-medium">{{ $slotNames[$slotNumber] }}</div>
                                            <div class="text-xs text-gray-400 mt-1">No recipe</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Planner Management Table -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">My Planner Recipes</h2>
            <p class="text-gray-600 mt-1">Manage your meal planning assignments</p>
        </div>

        @if($plannerEntries->count() > 0)
            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Recipe</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Current Assignment</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($plannerEntries as $entry)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <!-- Recipe Info -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-12 w-12 flex-shrink-0">
                                            @if($entry->recipe->image)
                                                <img class="h-12 w-12 rounded-lg object-cover" 
                                                     src="{{ asset('storage/' . $entry->recipe->image) }}" 
                                                     alt="{{ $entry->recipe->title }}"
                                                     onerror="this.src='{{ asset('storage/default-recipe.jpg') }}'">
                                            @else
                                                <div class="h-12 w-12 rounded-lg bg-gray-200 flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M8.1 13.34l2.83-2.83L3.91 3.5c-1.56 1.56-1.56 4.09 0 5.66l4.19 4.18zm6.78-1.81c1.53.71 3.68.21 5.27-1.38 1.91-1.91 2.28-4.65.81-6.12-1.46-1.46-4.20-1.10-6.12.81-1.59 1.59-2.09 3.74-1.38 5.27L3.7 19.87l1.41 1.41L12 14.41l6.88 6.88 1.41-1.41-6.88-6.88 1.37-1.37z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $entry->recipe->title }}</div>
                                            @if($entry->recipe->cooking_time)
                                                <div class="text-sm text-gray-500">{{ $entry->recipe->cooking_time }} min</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <!-- Current Assignment -->
                                <td class="px-6 py-4">
                                    @if($entry->day >= 1 && $entry->day <= 7 && $entry->slot >= 1 && $entry->slot <= 3)
                                        @php
                                            $dayNames = ['', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                            $slotNames = ['', 'Breakfast', 'Lunch', 'Dinner'];
                                            $slotColors = ['', 'bg-green-100 text-green-800', 'bg-blue-100 text-blue-800', 'bg-purple-100 text-purple-800'];
                                        @endphp
                                        <div class="space-y-1">
                                            <div class="text-sm font-medium text-gray-900">{{ $dayNames[$entry->day] }}</div>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $slotColors[$entry->slot] }}">
                                                {{ $slotNames[$entry->slot] }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-500 italic">Not assigned</span>
                                    @endif
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4">
                                    @if($entry->day >= 1 && $entry->day <= 7 && $entry->slot >= 1 && $entry->slot <= 3)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Scheduled
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            Pending
                                        </span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 text-sm font-medium space-x-2">
                                    <button onclick="btnClicked({{ $entry->planner_id }}, '{{ addslashes($entry->recipe->title) }}')"
                                            class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ ($entry->day >= 1 && $entry->day <= 7) ? 'Reschedule' : 'Schedule' }}
                                    </button>
                                    <button wire:click="remove({{ $entry->planner_id }})"
                                            onclick="return confirm('Are you sure you want to remove this recipe from your planner?')"
                                            class="inline-flex items-center px-3 py-1.5 border border-red-300 text-xs font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Remove
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden">
                @foreach($plannerEntries as $entry)
                    <div class="border-b border-gray-200 p-4">
                        <div class="flex items-start space-x-3">
                            <div class="h-16 w-16 flex-shrink-0">
                                @if($entry->recipe->image)
                                    <img class="h-16 w-16 rounded-lg object-cover" 
                                         src="{{ asset('storage/' . $entry->recipe->image) }}" 
                                         alt="{{ $entry->recipe->title }}"
                                         onerror="this.src='{{ asset('storage/default-recipe.jpg') }}'">
                                @else
                                    <div class="h-16 w-16 rounded-lg bg-gray-200 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8.1 13.34l2.83-2.83L3.91 3.5c-1.56 1.56-1.56 4.09 0 5.66l4.19 4.18zm6.78-1.81c1.53.71 3.68.21 5.27-1.38 1.91-1.91 2.28-4.65.81-6.12-1.46-1.46-4.20-1.10-6.12.81-1.59 1.59-2.09 3.74-1.38 5.27L3.7 19.87l1.41 1.41L12 14.41l6.88 6.88 1.41-1.41-6.88-6.88 1.37-1.37z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-sm font-medium text-gray-900 mb-1">{{ $entry->recipe->title }}</div>
                                @if($entry->day >= 1 && $entry->day <= 7 && $entry->slot >= 1 && $entry->slot <= 3)
                                    @php
                                        $dayNames = ['', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                        $slotNames = ['', 'Breakfast', 'Lunch', 'Dinner'];
                                        $slotColors = ['', 'bg-green-100 text-green-800', 'bg-blue-100 text-blue-800', 'bg-purple-100 text-purple-800'];
                                    @endphp
                                    <div class="text-sm text-gray-600 mb-2">{{ $dayNames[$entry->day] }} - {{ $slotNames[$entry->slot] }}</div>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Scheduled
                                    </span>
                                @else
                                    <div class="text-sm text-gray-500 mb-2">Not assigned</div>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                @endif
                                <div class="flex space-x-2 mt-3">
                                    <button onclick="btnClicked({{ $entry->planner_id }}, '{{ addslashes($entry->recipe->title) }}')"
                                            class="flex-1 inline-flex justify-center items-center px-3 py-2 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ ($entry->day >= 1 && $entry->day <= 7) ? 'Reschedule' : 'Schedule' }}
                                    </button>
                                    <button wire:click="remove({{ $entry->planner_id }})"
                                            onclick="return confirm('Remove this recipe?')"
                                            class="flex-1 inline-flex justify-center items-center px-3 py-2 border border-red-300 text-xs font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $plannerEntries->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8.1 13.34l2.83-2.83L3.91 3.5c-1.56 1.56-1.56 4.09 0 5.66l4.19 4.18zm6.78-1.81c1.53.71 3.68.21 5.27-1.38 1.91-1.91 2.28-4.65.81-6.12-1.46-1.46-4.20-1.10-6.12.81-1.59 1.59-2.09 3.74-1.38 5.27L3.7 19.87l1.41 1.41L12 14.41l6.88 6.88 1.41-1.41-6.88-6.88 1.37-1.37z"/>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No recipes in planner</h3>
                <p class="text-gray-600 mb-4">Add recipes from your favorites to start planning your meals.</p>
                <a href="{{ route('profile.favourites') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Go to Favorites
                </a>
            </div>
        @endif
    </div>

    <!-- Simple Modal for Day Selection -->
    <div x-data="{ 
        showModal: false, 
        modalTitle: '', 
        hiddenId: '',
        selectedValue: ''
    }"
    x-on:show-modal.window="showModal = true; modalTitle = $event.detail.title; hiddenId = $event.detail.id; console.log('Modal opened for:', $event.detail.title)"
    x-on:close-modal.window="showModal = false; selectedValue = ''; console.log('Modal closed')"
    x-show="showModal"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 overflow-y-auto"
    style="display: none;">
        
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-50" x-on:click="showModal = false"></div>
        
        <!-- Modal content -->
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                
                <!-- Modal header -->
                <div class="flex items-center justify-between mb-4">
                    <h3 x-text="modalTitle" class="text-lg font-medium leading-6 text-gray-900"></h3>
                    <button x-on:click="showModal = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Modal body -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Select meal time</label>
                    <select x-model="selectedValue" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select meal time</option>
                        <optgroup label="Monday" class="font-semibold">
                            <option value="11">Breakfast</option>
                            <option value="12">Lunch</option>
                            <option value="13">Dinner</option>
                        </optgroup>
                        <optgroup label="Tuesday" class="font-semibold">
                            <option value="21">Breakfast</option>
                            <option value="22">Lunch</option>
                            <option value="23">Dinner</option>
                        </optgroup>
                        <optgroup label="Wednesday" class="font-semibold">
                            <option value="31">Breakfast</option>
                            <option value="32">Lunch</option>
                            <option value="33">Dinner</option>
                        </optgroup>
                        <optgroup label="Thursday" class="font-semibold">
                            <option value="41">Breakfast</option>
                            <option value="42">Lunch</option>
                            <option value="43">Dinner</option>
                        </optgroup>
                        <optgroup label="Friday" class="font-semibold">
                            <option value="51">Breakfast</option>
                            <option value="52">Lunch</option>
                            <option value="53">Dinner</option>
                        </optgroup>
                        <optgroup label="Saturday" class="font-semibold">
                            <option value="61">Breakfast</option>
                            <option value="62">Lunch</option>
                            <option value="63">Dinner</option>
                        </optgroup>
                        <optgroup label="Sunday" class="font-semibold">
                            <option value="71">Breakfast</option>
                            <option value="72">Lunch</option>
                            <option value="73">Dinner</option>
                        </optgroup>
                    </select>
                    
                    <!-- Schedule button -->
                    <button x-show="selectedValue" 
                            x-on:click="
                                console.log('Scheduling:', selectedValue, 'for planner ID:', hiddenId);
                                @this.call('updatePlanner', selectedValue, hiddenId).then(() => {
                                    console.log('Successfully scheduled!');
                                    showModal = false;
                                    selectedValue = '';
                                }).catch((error) => {
                                    console.error('Error scheduling:', error);
                                });
                            "
                            class="mt-4 w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        Schedule Recipe
                    </button>
                </div>
                
                <!-- Modal footer -->
                <div class="flex justify-end">
                    <button x-on:click="showModal = false; selectedValue = ''" 
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function changeSlot(v, day) {
        @this.call('updateSlot', v, day)
    }

    function btnClicked(id, title) {
        console.log('Opening modal for:', title, 'ID:', id);
        window.dispatchEvent(new CustomEvent('show-modal', {
            detail: { id: id, title: title }
        }));
    }
</script>
