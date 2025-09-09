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
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ];
    }

    protected $messages = [
        'title.required' => 'The title field is required.',
        'title.max' => 'The title may not be greater than 100 characters.',
        'description.required' => 'The description field is required.',
        'description.max' => 'The description may not be greater than 250 characters.',
        'image.required' => 'Please select an image.',
        'image.file' => 'The file must be a valid file.',
        'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, webp.',
        'image.max' => 'The image may not be greater than 2MB.'
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
        
        // Additional check for file upload errors
        if ($this->image && !$this->image->isValid()) {
            $this->addError('image', 'The image failed to upload. Please try again.');
        }
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
        // Check if image is present and valid before validation
        if (!$this->image || !$this->image->isValid()) {
            $this->addError('image', 'Please select a valid image file.');
            return;
        }
        
        $this->validate();

        // Generate unique filename first
        try {
            $imageName = 'hashtag_' . time() . '_' . uniqid() . '.' . $this->image->getClientOriginalExtension();
        } catch (\Exception $e) {
            $this->addError('image', 'Invalid image file. Please select a different image.');
            return;
        }
        
        // Store the image first
        try {
            $this->image->storeAs('public', $imageName);
        } catch (\Exception $e) {
            $this->dispatch('toast', ['text' => 'Failed to upload image: ' . $e->getMessage(), 'type' => 'error']);
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
            Storage::delete('public/' . $imageName);
            $this->dispatch('toast', ['text' => 'Failed to save category: ' . $e->getMessage(), 'type' => 'error']);
        }
    }
}
