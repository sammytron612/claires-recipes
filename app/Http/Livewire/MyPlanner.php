<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;
use App\Models\Planner;
use Livewire\WithPagination;

class MyPlanner extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
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

        $this->plannerEntries = Planner::where('user_id',Auth::user()->id)->orderBy('day')->paginate(12);

        return view('livewire.my-planner', (['plannerEntries' => $this->plannerEntries]));
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


        //$this->plannerEntries = Planner::where('user_id',Auth::user()->id)->orderBy('day')->paginate(12);
        $this->emit('hideModalDays');
        if($planner)
       {
            $message = ['text' =>  'Entry updated','type' => 'success'];
            $this->emit('toast', $message);
       }

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
        $this->emit('toast', $message);
    }
}
