<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Ingredient;
use App\Models\Diet;
use App\Models\Course;
use App\Models\Cuisine;
use App\Models\Method;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;



class CategoryTable extends Component
{

    public $selection = null;
    protected $categories = null;
    public $editId;
    public $editTitle;
    public $editDescription;
    public $editImage;
    public $updatedImage = null;
    public $visible = false;
    public $limit = 20;
    public $searchTerm = "";

    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {

        if($this->selection)
        {
            if($this->selection == 1 )
            {
                $this->visible = True;
                $this->categories = Ingredient::where('title','like','%'.$this->searchTerm.'%')->orderBy('title')->paginate(20);
            }

            if($this->selection == 2 )
            {

                $this->visible = False;
                $this->categories = Cuisine::orderBy('title')->paginate(20);;

            }

            if($this->selection == 3 )
            {

                $this->visible = False;
                $this->categories = Diet::orderBy('title')->paginate(20);;

            }

            if($this->selection == 4 )
            {
                $this->visible = False;
                $this->categories = Course::orderBy('title')->paginate(20);;


            }

            if($this->selection == 5 )
            {

                $this->visible = False;
                $this->categories = Method::orderBy('title')->paginate(20);;

            }
        }
        return view('livewire.category-table',(['categories' => $this->categories]));
    }

    public function updating()
    {
        $this->resetPage();
    }

    public function editHashtag($id)
    {
        if($this->selection == 1 )
            {
                $ingredient= Ingredient::find($id);
                $this->editTitle = $ingredient->title;
                $this->editDescription = $ingredient->description;
                $this->editImage = $ingredient->image;
                $this->editId = $id;
            }
        if($this->selection == 2 )
            {
                $cuisine = Cuisine::find($id);
                $this->editTitle = $cuisine->title;
                $this->editDescription = $cuisine->description;
                $this->editImage = $cuisine->image;
                $this->editId = $id;
            }
        if($this->selection == 3 )
            {
                $diet = Diet::find($id);
                $this->editTitle = $diet->title;
                $this->editDescription = $diet->description;
                $this->editImage = $diet->image;
                $this->editId = $id;
            }
        if($this->selection == 4 )
            {
                $course = Course::find($id);
                $this->editTitle = $course->title;
                $this->editDescription = $course->description;
                $this->editImage = $course->image;
                $this->editId = $id;
            }
            if($this->selection == 5 )
            {
                $method = Method::find($id);
                $this->editTitle = $method->title;
                $this->editDescription = $method->description;
                $this->editImage = $method->image;
                $this->editId = $id;
            }



    }



    public function updateHashtag()
    {

        $this->validate([
            'editTitle' =>  'required|max:100',
            'editDescription' => 'required|max:250',
            'updatedImage' => 'nullable|image|max:1024'
            ]);

        if($this->selection == 1 )
            {
                $ingredient = Ingredient::find($this->editId);
                $slug = (str_replace(' ', '-', strtolower($this->editTitle)));
                $slug .= '-' . $this->editId;
                $ingredient->title = $this->editTitle;
                $ingredient->slug = $slug;
                $ingredient->description = $this->editDescription;
                if($this->updatedImage)
                {
                    $ingredient->image = md5($this->updatedImage . microtime()).'.'.$this->updatedImage->extension();
                    $this->updatedImage->storeAs('public', $ingredient->image);
                    Storage::delete($ingredient->image);
                }
                $ingredient->save();
            }

        if($this->selection == 2 )
            {
                $cuisine = Cuisine::find($this->editId);
                $slug = (str_replace(' ', '-', strtolower($this->editTitle)));
                $cuisine->title = $this->editTitle;
                $slug .= '-' . $this->editId;
                $cuisine->slug = $slug;
                $cuisine->description = $this->editDescription;
                if($this->updatedImage)
                {
                    Storage::delete($cuisine->image);
                    $cuisine->image = md5($this->updatedImage . microtime()).'.'.$this->updatedImage->extension();
                    $this->updatedImage->storeAs('public', $cuisine->image);
                }
                $cuisine->save();
            }
        if($this->selection == 3 )
            {
                $diet = Diet::find($this->editId);
                $slug = (str_replace(' ', '-', strtolower($this->editTitle)));
                $diet->title = $this->editTitle;
                $slug .= '-' . $this->editId;
                $diet->slug = $slug;
                $diet->description = $this->editDescription;
                if($this->updatedImage)
                {
                    Storage::delete($diet->image);
                    $diet->image = md5($this->updatedImage . microtime()).'.'.$this->updatedImage->extension();
                    $this->updatedImage->storeAs('public', $diet->image);
                }
                $diet->save();
            }
        if($this->selection == 4 )
            {
                $course = Course::find($this->editId);
                $slug = (str_replace(' ', '-', strtolower($this->editTitle)));
                $slug .= '-' . $this->editId;
                $course->title = $this->editTitle;
                $course->slug = $slug;
                $course->description = $this->editDescription;
                if($this->updatedImage)
                {
                    Storage::delete($course->image);
                    $course->image = md5($this->updatedImage . microtime()).'.'.$this->updatedImage->extension();
                    $this->updatedImage->storeAs('public', $course->image);
                }
                $course->save();
            }
        if($this->selection == 5 )
            {
                $method = Method::find($this->editId);
                $slug = (str_replace(' ', '-', strtolower($this->editTitle)));
                $slug .= '-' . $this->editId;
                $method->title = $this->editTitle;
                $method->slug = $slug;
                $method->description = $this->editDescription;
                if($this->updatedImage)
                {
                    Storage::delete($method->image);
                    $method->image = md5($this->updatedImage . microtime()).'.'.$this->updatedImage->extension();
                    $this->updatedImage->storeAs('public', $method->image);
                }
                $method->save();
            }


        $this->emit('hideModalEdit');
        $message = ['text' =>  'Updated','type' => 'success'];
        $this->reset(['editTitle','editDescription','editImage','updatedImage']);
        $this->emit('toast', $message);

    }

    public function destroyHashtag($id)
    {
        if($this->selection == 1 )
            {
                $ingredient= Ingredient::find($id);
                Storage::delete($ingredient->image);
                $ingredient->delete();
            }

        if($this->selection == 2 )
            {
                $cuisine= Cuisine::find($id);
                Storage::delete($cuisine->image);
                $cuisine->delete();
            }

        if($this->selection == 3 )
            {
                $diet = Diet::find($id);
                Storage::delete($diet->image);
                $diet->delete();
            }

        if($this->selection == 4 )
            {
                $course = Course::find($id);
                Storage::delete($course->image);
                $course->delete();
            }
        if($this->selection == 5 )
            {
                $method = Method::find($id);
                Storage::delete($method->image);
                $method->delete();
            }

        $message = ['text' => 'Deleted','type' => 'success'];
        $this->emit('toast', $message);

    }


}
