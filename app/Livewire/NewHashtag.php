<?php

namespace App\\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
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

    public function render()
    {
        return view('livewire.new-hashtag');
    }

    public function storeHashtag()
    {

        $this->validate([
            'title' =>  'required|max:100',
            'description' => 'required|max:250',
            'image' => 'required|image|max:1024']);

        $data =[
                'title' =>  $this->title,
                'description' => $this->description,
                'image' => md5($this->image . microtime()).'.'.$this->image->extension()];

        $slug = (str_replace(' ', '-', strtolower($this->title)));

        if($this->category == "ingredient")
        {
            $id = Ingredient::create($data)->id;
            Ingredient::where('id', $id)->update(['slug' => $slug . '-' . $id]);
        }

        if($this->category == "cuisine")
        {
            $id = Cuisine::create($data)->id;
            Cuisine::where('id', $id)->update(['slug' => $slug . '-' . $id]);
        }

        if($this->category == "course")
        {
            Course::create($data);
            Course::where('id', $id)->update(['slug' => $slug . '-' . $id]);

        }

        if($this->category == "diet")
        {
            Diet::create($data);
            Diet::where('id', $id)->update(['slug' => $slug . '-' . $id]);
        }

        if($this->category == "method")
        {
            Method::create($data);
            Method::where('id', $id)->update(['slug' => $slug . '-' . $id]);
        }

        $this->image->storeAs('public', $data['image']);
        $this->reset(['title', 'description', 'image']);
        $this->emit('hideModal');

        $message = ['text' => 'Recipe added','type' => 'success'];
        $this->emit('toast', $message);

    }
}
