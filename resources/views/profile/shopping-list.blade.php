@extends('layouts.app', [
    'title' => 'Shopping List | Claire\'s Recipes',
    'description' => 'Manage your shopping list for planned meals and recipes.',
])

@section('content')
<style>
@media print {
    body * {
        visibility: hidden;
    }
    
    .print-only, .print-only * {
        visibility: visible;
    }
    
    .print-only {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        padding: 20px;
    }
    
    .no-print {
        display: none !important;
    }
    
    .print-checkbox {
        width: 15px;
        height: 15px;
        border: 2px solid #000;
        margin-right: 10px;
    }
}
</style>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8 no-print">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Weekly Shopping List</h1>
        <p class="text-gray-600">Ingredients organized by day from your meal planner</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Daily Meal Plans & Ingredients -->
        <div class="lg:col-span-2 space-y-8 no-print">
            @if($plannerByDay->count() > 0)
                <div x-data="dayNavigation()" class="space-y-6">
                    
                    <!-- Navigation Controls -->
                    <div class="flex items-center justify-between bg-gradient-to-r from-purple-600 to-indigo-700 rounded-lg shadow-lg border border-purple-300 p-4">
                        <button @click="prevDay()" 
                                :disabled="currentDay === 0"
                                :class="currentDay === 0 ? 'text-white/50 cursor-not-allowed' : 'text-white hover:text-purple-200'"
                                class="flex items-center space-x-2 px-4 py-2 rounded-lg transition-colors bg-white/10 hover:bg-white/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            <span class="font-medium">Previous Day</span>
                        </button>
                        
                        <div class="text-center">
                            <h2 class="text-2xl font-bold text-white" x-text="dayNames[currentDayNumber] || 'Day ' + currentDayNumber"></h2>
                            <p class="text-sm text-purple-100" x-text="'Day ' + (currentDay + 1) + ' of ' + days.length"></p>
                        </div>
                        
                        <button @click="nextDay()" 
                                :disabled="currentDay === days.length - 1"
                                :class="currentDay === days.length - 1 ? 'text-white/50 cursor-not-allowed' : 'text-white hover:text-purple-200'"
                                class="flex items-center space-x-2 px-4 py-2 rounded-lg transition-colors bg-white/10 hover:bg-white/20">
                            <span class="font-medium">Next Day</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Day Cards -->
                    @foreach($plannerByDay as $day => $plannerItems)
                        <div x-show="currentDayNumber === {{ $day }}" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform translate-x-10"
                             x-transition:enter-end="opacity-100 transform translate-x-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 transform translate-x-0"
                             x-transition:leave-end="opacity-0 transform -translate-x-10"
                             class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                            <div class="p-6">
                            <!-- Planned Meals -->
                            <div class="mb-6">
                                <div class="bg-gradient-to-r from-teal-500 to-blue-600 rounded-lg p-4 mb-4">
                                    <h3 class="text-lg font-medium text-white mb-0 flex items-center">
                                        <svg class="w-5 h-5 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Planned Meals
                                    </h3>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    @foreach($plannerItems as $plannerItem)
                                        @if($plannerItem->recipe)
                                            <div class="bg-gray-50 rounded-lg p-4">
                                                <div class="text-sm text-teal-600 font-medium mb-1">
                                                    {{ $slotNames[$plannerItem->slot] ?? 'Meal ' . $plannerItem->slot }}
                                                </div>
                                                <div class="font-medium text-gray-900">
                                                    {{ $plannerItem->recipe->title }}
                                                </div>
                                                @if($plannerItem->recipe->photo)
                                                    <img src="{{ Storage::url($plannerItem->recipe->photo) }}" 
                                                         alt="{{ $plannerItem->recipe->title }}"
                                                         class="w-full h-20 object-cover rounded mt-2">
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <!-- Ingredients for this day -->
                            @if(isset($ingredientsByDay[$day]) && $ingredientsByDay[$day]->count() > 0)
                                <div>
                                    <div class="bg-gradient-to-r from-orange-500 to-red-600 rounded-lg p-4 mb-4">
                                        <h3 class="text-lg font-medium text-white mb-0 flex items-center">
                                            <svg class="w-5 h-5 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h2m0 0h2m-2 0v2a2 2 0 002 2h2a2 2 0 002-2v-2m0 0V9a2 2 0 00-2-2H9"></path>
                                            </svg>
                                            Ingredients Needed
                                        </h3>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        @foreach($ingredientsByDay[$day] as $item)
                                            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                                <input type="checkbox" 
                                                       class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded"
                                                       id="ingredient-{{ $day }}-{{ md5($item['ingredient']) }}">
                                                <label for="ingredient-{{ $day }}-{{ md5($item['ingredient']) }}" 
                                                       class="flex-1 cursor-pointer">
                                                    <div class="font-medium text-gray-900">
                                                        {{ $item['ingredient'] }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        For {{ $item['recipe']->title }} ({{ $slotNames[$item['slot']] }})
                                                    </div>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h2m0 0h2m-2 0v2a2 2 0 002 2h2a2 2 0 002-2v-2m0 0V9a2 2 0 00-2-2H9"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No meals planned yet</h3>
                    <p class="text-gray-500 mb-4">Start planning your week to generate a shopping list</p>
                    <a href="{{ route('profile.planner') }}" 
                       class="inline-flex items-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-md transition-colors">
                        Go to Meal Planner
                    </a>
                </div>
            @endif
        </div>

        <!-- Master Shopping List Sidebar -->
        <div class="space-y-6">
            <!-- Summary Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 no-print">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Shopping Summary</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Days planned:</span>
                        <span class="font-medium">{{ $plannerByDay->count() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total recipes:</span>
                        <span class="font-medium">{{ $list->count() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Unique ingredients:</span>
                        <span class="font-medium">{{ $uniqueIngredients->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Master Shopping List -->
            @if($uniqueIngredients->count() > 0)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 print-only">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center no-print">
                        <svg class="w-5 h-5 text-teal-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Master Shopping List
                    </h3>
                    
                    <!-- Print Header (only visible when printing) -->
                    <div class="hidden print:block text-center mb-6">
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Claire's Recipes - Shopping List</h1>
                        <p class="text-gray-600">Generated on {{ date('F j, Y') }}</p>
                        <hr class="my-4 border-gray-300">
                    </div>
                    
                    <div class="space-y-2 max-h-96 overflow-y-auto print:max-h-none print:overflow-visible">
                        @foreach($uniqueIngredients as $ingredient)
                            <div class="flex items-center space-x-3 py-2 print:py-3">
                                <input type="checkbox" 
                                       class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded no-print"
                                       id="master-{{ md5($ingredient) }}">
                                <div class="print-checkbox hidden print:inline-block"></div>
                                <label for="master-{{ md5($ingredient) }}" 
                                       class="flex-1 text-sm text-gray-700 cursor-pointer hover:text-gray-900 print:text-base print:cursor-default">
                                    {{ $ingredient }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3 no-print">
                    <button onclick="window.print()" 
                            class="w-full bg-teal-600 hover:bg-teal-700 text-white font-medium py-2 px-4 rounded-lg transition-colors flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Print Shopping List
                    </button>
                    <a href="{{ route('profile.planner') }}" 
                       class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-lg transition-colors flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v9a1 1 0 01-1 1H5a1 1 0 01-1-1V8a1 1 0 011-1h3z"></path>
                        </svg>
                        Edit Meal Plan
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add functionality to check off items
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const label = this.nextElementSibling;
            if (this.checked) {
                label.style.textDecoration = 'line-through';
                label.style.opacity = '0.6';
            } else {
                label.style.textDecoration = 'none';
                label.style.opacity = '1';
            }
        });
    });
});
</script>

@endsection

<script>
function dayNavigation() {
    return {
        currentDay: 0,
        days: @json($plannerByDay->keys()->values()),
        dayNames: @json($dayNames),
        get currentDayNumber() {
            return this.days[this.currentDay];
        },
        nextDay() {
            if (this.currentDay < this.days.length - 1) {
                this.currentDay++;
            }
        },
        prevDay() {
            if (this.currentDay > 0) {
                this.currentDay--;
            }
        }
    }
}
</script>