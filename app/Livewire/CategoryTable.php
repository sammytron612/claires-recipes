<?php

namespace App\Livewire;

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
    public $selection = '';
    public $editId;
    public $editTitle;
    public $editDescription;
    public $editImage;
    public $updatedImage = null;
    public $visible = false;
    public $limit = 20;
    public $searchTerm = "";
    public $showEditModal = false;

    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $this->selection = '';
        $this->visible = false;
        $this->searchTerm = '';
        $this->showEditModal = false;
    }

    public function render()
    {
        $categories = collect(); // Start with empty collection
        
        if($this->selection === '1') {
            $this->visible = true;
            $query = Ingredient::query();
            if($this->searchTerm) {
                $query->where('title', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $this->searchTerm . '%');
            }
            $categories = $query->paginate(15);
        } elseif($this->selection === '2') {
            $this->visible = true;
            $query = Cuisine::query();
            if($this->searchTerm) {
                $query->where('title', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $this->searchTerm . '%');
            }
            $categories = $query->paginate(15);
        } elseif($this->selection === '3') {
            $this->visible = true;
            $query = Diet::query();
            if($this->searchTerm) {
                $query->where('title', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $this->searchTerm . '%');
            }
            $categories = $query->paginate(15);
        } elseif($this->selection === '4') {
            $this->visible = true;
            $query = Course::query();
            if($this->searchTerm) {
                $query->where('title', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $this->searchTerm . '%');
            }
            $categories = $query->paginate(15);
        } elseif($this->selection === '5') {
            $this->visible = true;
            $query = Method::query();
            if($this->searchTerm) {
                $query->where('title', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $this->searchTerm . '%');
            }
            $categories = $query->paginate(15);
        } else {
            $this->visible = false;
        }

        return view('livewire.category-table', compact('categories'));
    }

    public function updatedSelection()
    {
        $this->resetPage();
        $this->searchTerm = '';
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function editHashtag($id)
    {
        $this->editId = $id;
        
        switch($this->selection) {
            case '1':
                $item = Ingredient::find($id);
                break;
            case '2':
                $item = Cuisine::find($id);
                break;
            case '3':
                $item = Diet::find($id);
                break;
            case '4':
                $item = Course::find($id);
                break;
            case '5':
                $item = Method::find($id);
                break;
            default:
                return;
        }

        if ($item) {
            $this->editTitle = $item->title;
            $this->editDescription = $item->description;
            $this->editImage = $item->image;
            $this->showEditModal = true;
        }
    }



    public function updateHashtag()
    {
        $this->validate([
            'editTitle' =>  'required|max:100',
            'editDescription' => 'required|max:250',
            'updatedImage' => 'nullable|image|max:1024'
        ]);

        $item = null;
        
        switch($this->selection) {
            case '1':
                $item = Ingredient::find($this->editId);
                break;
            case '2':
                $item = Cuisine::find($this->editId);
                break;
            case '3':
                $item = Diet::find($this->editId);
                break;
            case '4':
                $item = Course::find($this->editId);
                break;
            case '5':
                $item = Method::find($this->editId);
                break;
        }

        if ($item) {
            $slug = str_replace(' ', '-', strtolower($this->editTitle)) . '-' . $this->editId;
            
            $item->title = $this->editTitle;
            $item->slug = $slug;
            $item->description = $this->editDescription;
            
            if($this->updatedImage) {
                // Delete old image if exists
                if($item->image) {
                    Storage::delete('public/' . $item->image);
                }
                
                $item->image = md5($this->updatedImage . microtime()).'.'.$this->updatedImage->extension();
                $this->updatedImage->storeAs('public', $item->image);
            }
            
            $item->save();
        }

        $this->reset(['editTitle','editDescription','editImage','updatedImage']);
        $this->showEditModal = false;
        $this->dispatch('toast', ['text' => 'Category updated successfully', 'type' => 'success']);
    }

    public function destroyHashtag($id)
    {
        $item = null;
        
        switch($this->selection) {
            case '1':
                $item = Ingredient::find($id);
                break;
            case '2':
                $item = Cuisine::find($id);
                break;
            case '3':
                $item = Diet::find($id);
                break;
            case '4':
                $item = Course::find($id);
                break;
            case '5':
                $item = Method::find($id);
                break;
        }

        if ($item) {
            if($item->image) {
                Storage::delete('public/' . $item->image);
            }
            $item->delete();
        }

        $this->dispatch('toast', ['text' => 'Deleted', 'type' => 'success']);
    }


}
