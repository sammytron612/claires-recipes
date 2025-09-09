<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Ingredient;
use App\Models\Cuisine;
use App\Models\Method;
use App\Models\Course;
use App\Models\Diet;


class NewHashtag extends Component
{
    public $category;
    public $image;
    public $title;
    public $description;

    use WithFileUploads;

    protected function rules()
    {
        return [
            'title' => 'required|max:100',
            'description' => 'required|max:250',
            'image' => 'required|image|max:1024'
        ];
    }

    protected $messages = [
        'title.required' => 'The title field is required.',
        'title.max' => 'The title may not be greater than 100 characters.',
        'description.required' => 'The description field is required.',
        'description.max' => 'The description may not be greater than 250 characters.',
        'image.required' => 'Please select an image.',
        'image.image' => 'The file must be an image.',
        'image.max' => 'The image may not be greater than 1MB.'
    ];

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function updatedTitle()
    {
        $this->validateOnly('title');
    }

    public function updatedDescription()
    {
        $this->validateOnly('description');
    }

    public function updatedImage()
    {
        $this->validateOnly('image');
    }

    public function resetForm()
    {
        $this->reset(['title', 'description', 'image', 'category']);
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.new-hashtag');
    }

    public function storeHashtag()
    {
        $this->validate();

        // Generate unique filename first
        $imageName = 'hashtag_' . time() . '_' . uniqid() . '.' . $this->image->extension();
        
        // Store the image first
        try {
            $this->image->storeAs('public', $imageName);
        } catch (\Exception $e) {
            
            return;
        }
        
        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'image' => $imageName
        ];

        $slug = str_replace(' ', '-', strtolower($this->title));
        
        $id = null;
        
        try {
            switch($this->category) {
                case "ingredient":
                    $item = Ingredient::create($data);
                    $id = $item->id;
                    $item->update(['slug' => $slug . '-' . $id]);
                    break;
                    
                case "cuisine":
                    $item = Cuisine::create($data);
                    $id = $item->id;
                    $item->update(['slug' => $slug . '-' . $id]);
                    break;
                    
                case "course":
                    $item = Course::create($data);
                    $id = $item->id;
                    $item->update(['slug' => $slug . '-' . $id]);
                    break;
                    
                case "diet":
                    $item = Diet::create($data);
                    $id = $item->id;
                    $item->update(['slug' => $slug . '-' . $id]);
                    break;
                    
                case "method":
                    $item = Method::create($data);
                    $id = $item->id;
                    $item->update(['slug' => $slug . '-' . $id]);
                    break;
                    
                default:
                    throw new \Exception('Invalid category selected');
            }
            
            // Reset form
            $this->reset(['title', 'description', 'image']);
            
            // Dispatch success events
            $this->dispatch('hideModal');
            $this->dispatch('toast', ['text' => 'Category added successfully', 'type' => 'success']);
            
        } catch (\Exception $e) {
            // If database save fails, delete the uploaded image
            \Storage::delete('public/' . $imageName);
            $this->dispatch('toast', ['text' => 'Failed to save category: ' . $e->getMessage(), 'type' => 'error']);
        }
    }
}
