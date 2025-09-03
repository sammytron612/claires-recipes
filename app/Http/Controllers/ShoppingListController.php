<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planner;

class ShoppingListController extends Controller
{
    public function index()
    {
        // Get planner entries with recipe and ingredients relationships
        $list = Planner::with(['recipe', 'recipe.recipeIngredients'])
            ->where('user_id', auth()->id())
            ->where('day', '<>', 8)
            ->orderBy('day')
            ->orderBy('slot')
            ->get();

        // Group planner entries by day
        $plannerByDay = $list->groupBy('day');

        // Define day names for better display
        $dayNames = [
            1 => 'Monday',
            2 => 'Tuesday', 
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
            7 => 'Sunday'
        ];

        // Define slot names
        $slotNames = [
            1 => 'Breakfast',
            2 => 'Lunch',
            3 => 'Dinner'
        ];

        // Organize ingredients by day
        $ingredientsByDay = [];
        $allIngredients = collect();

        foreach ($plannerByDay as $day => $plannerItems) {
            $dayIngredients = collect();
            
            foreach ($plannerItems as $plannerItem) {
                if ($plannerItem->recipe && $plannerItem->recipe->recipeIngredients) {
                    $ingredientsArray = $plannerItem->recipe->recipeIngredients->ingredients ?? [];
                    foreach ($ingredientsArray as $ingredient) {
                        // Add ingredient with recipe context
                        $dayIngredients->push([
                            'ingredient' => $ingredient,
                            'recipe' => $plannerItem->recipe,
                            'slot' => $plannerItem->slot,
                            'day' => $day
                        ]);
                        
                        // Add to all ingredients collection
                        $allIngredients->push($ingredient);
                    }
                }
            }
            
            // Remove duplicate ingredients for the day (by ingredient name)
            $ingredientsByDay[$day] = $dayIngredients->unique('ingredient');
        }

        // Get unique ingredients across all days for master shopping list
        $uniqueIngredients = $allIngredients->unique()->sort();

        return view('profile.shopping-list', compact(
            'list', 
            'plannerByDay', 
            'ingredientsByDay', 
            'uniqueIngredients',
            'dayNames',
            'slotNames'
        ));
    }
}
