<?php

namespace App\Livewire;

use Livewire\Component;
use Auth;
use App\Models\Planner;
use Livewire\WithPagination;

class MyPlanner extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';
    protected $plannerEntries;

    public $monday;
    public $tuesday;
    public $wednesday;
    public $thursday;
    public $friday;
    public $saturday;
    public $sunday;


    private function refreshDays()
    {


        $this->monday = Planner::where('user_id',Auth::user()->id)
                        ->where('day', '1')->orderBy('slot')->limit(1)->get();


        $this->tuesday = Planner::where('user_id',Auth::user()->id)
                        ->where('day', '2')->orderBy('slot')->limit(1)->get();

        $this->wednesday = Planner::where('user_id',Auth::user()->id)
                        ->where('day', '3')->orderBy('slot')->get();

        $this->thursday = Planner::where('user_id',Auth::user()->id)
                        ->where('day', '4')->orderBy('slot')->get();

        $this->friday = Planner::where('user_id',Auth::user()->id)
                        ->where('day', '5')->orderBy('slot')->get();

        $this->saturday = Planner::where('user_id',Auth::user()->id)
                        ->where('day', '6')->orderBy('slot')->get();

        $this->sunday = Planner::where('user_id',Auth::user()->id)
                        ->where('day', '7')->orderBy('slot')->get();
        return;
    }





    public function mount()
    {

        $this->refreshDays();

    }


    public function render()
    {
        // Get planner entries with recipe details
        $this->plannerEntries = Planner::with('recipe')
            ->where('user_id', Auth::user()->id)
            ->orderBy('day')
            ->orderBy('slot')
            ->paginate(12);

        // Simple weekly schedule for the card view
        $weeklySchedule = [
            1 => ['name' => 'Monday', 'number' => 1],
            2 => ['name' => 'Tuesday', 'number' => 2],
            3 => ['name' => 'Wednesday', 'number' => 3],
            4 => ['name' => 'Thursday', 'number' => 4],
            5 => ['name' => 'Friday', 'number' => 5],
            6 => ['name' => 'Saturday', 'number' => 6],
            7 => ['name' => 'Sunday', 'number' => 7]
        ];

        return view('livewire.my-planner', [
            'plannerEntries' => $this->plannerEntries,
            'weeklySchedule' => $weeklySchedule
        ]);
    }

    public function getRecipeForSlot($day, $slot)
    {
        $plannerEntry = Planner::with('recipe')
            ->where('user_id', Auth::user()->id)
            ->where('day', $day)
            ->where('slot', $slot)
            ->first();
        
        if ($plannerEntry && $plannerEntry->recipe) {
            return [
                'id' => $plannerEntry->recipe->id,
                'slug' => $plannerEntry->recipe->slug,
                'title' => $plannerEntry->recipe->title,
                'image' => $plannerEntry->recipe->image,
                'cooking_time' => $plannerEntry->recipe->cooking_time,
                'servings' => $plannerEntry->recipe->servings ?? null,
                'description' => $plannerEntry->recipe->description ?? null
            ];
        }
        
        return null;
    }

    public function updatePlanner($day, $plannerId)
    {
        if($day == 8)
        {
            $planner = Planner::where('planner_id', $plannerId)->update(['day' => 8, 'slot' => 0]);
            $this->refreshDays();
        }
        else
        {

            $slot = substr($day, -1);
            $day = substr_replace($day ,"",-1);


            $exists = Planner::where('user_id', Auth::user()->id)
                        ->where('day',$day)->where('slot',$slot)->get();



            foreach($exists as $item)
            {
                $item->day = 8;
                $item->slot = 0;
                $item->save();
            }

            $planner = Planner::where('planner_id', $plannerId)->update(['day' => $day, 'slot' => $slot]);

            $this->refreshDays();

        }


        // Force refresh of the component
        $this->resetPage();
        
        if($planner)
       {
            $message = ['text' =>  'Entry updated','type' => 'success'];
            $this->dispatch('toast', $message);
            return true; // Return success for the promise
       }
       
       return false;

    }

    public function updateSlot($slot,$day)
    {


        switch ($day) {
            case "1":
                $exists = Planner::where('user_id',Auth::user()->id)
                    ->where('day', '1')->where('slot',$slot)->limit(1)->get();

                if($exists->isNotEmpty())
                {
                    $this->monday = $exists;
                }
                else
                {
                    $this->monday = ['slot' => $slot];
                }
              break;

            case "2":
              $exists = Planner::where('user_id',Auth::user()->id)
                        ->where('day', '2')->where('slot',$slot)->limit(1)->get();

                if($exists->isNotEmpty())
                {
                    $this->tuesday = $exists;
                }
                else
                {
                    $this->tuesday = ['slot' => $slot];
                }
              break;

            case "3":
                $exists = Planner::where('user_id',Auth::user()->id)
                    ->where('day', '3')->where('slot',$slot)->limit(1)->get();

                if($exists->isNotEmpty())
                {
                    $this->wednesday = $exists;
                }
                else
                {
                    $this->wednesday = ['slot' => $slot];
                }
              break;

            case "4":
                $exists = Planner::where('user_id',Auth::user()->id)
                        ->where('day', '4')->where('slot',$slot)->limit(1)->get();

                if($exists->isNotEmpty())
                {
                    $this->thursday = $exists;
                }
                else
                {
                    $this->thursday = ['slot' => $slot];
                }
                break;

            case "5":
                $exists = Planner::where('user_id',Auth::user()->id)
                        ->where('day', '5')->where('slot',$slot)->limit(1)->get();

                if($exists->isNotEmpty())
                {
                    $this->friday = $exists;
                }
                else
                {
                    $this->friday = ['slot' => $slot];
                }
                break;

            case "6":
                $exists = Planner::where('user_id',Auth::user()->id)
                        ->where('day', '6')->where('slot',$slot)->limit(1)->get();

                if($exists->isNotEmpty())
                {
                    $this->saturday = $exists;
                }
                else
                {
                    $this->saturday = ['slot' => $slot];
                }
                break;

            case "7":
                $exists = Planner::where('user_id',Auth::user()->id)
                        ->where('day', '7')->where('slot',$slot)->limit(1)->get();

                if($exists->isNotEmpty())
                {
                    $this->sunday = $exists;
                }
                else
                {
                    $this->sunday = ['slot' => $slot];
                }
                break;

            }

    }

    public function remove($id)
    {
        Planner::where('planner_id', $id)->delete();
        $this->plannerEntries = Planner::where('user_id',Auth::user()->id)->orderBy('day')->paginate(12);
        $this->refreshDays();

        $message = ['text' =>  'Entry removed','type' => 'success'];
        $this->dispatch('toast', $message);
    }
}
