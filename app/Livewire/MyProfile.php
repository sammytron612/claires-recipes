<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

use App\Models\User;



class MyProfile extends Component
{

    public $avatar;
    public $fail;
    public $uploaded = false;
    use WithFileUploads;



    public function render()
    {
        return view('livewire.my-profile');
    }

    public function updated()
    {
        $this->validate([
            'avatar' => 'image|max:1024',
            ]);
        $this->uploaded = true;
    }


    public function uploadAvatar(User $user)
    {
        // Security: Ensure user can only upload their own avatar
        if ($user->id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $this->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024']);

        $avatar = md5($this->avatar . microtime()).'.'.$this->avatar->extension();
        $this->avatar->storeAs('public', $avatar);

        $user->avatar = $avatar;
        $user->save();

        $message = ['text' =>  'Avatar uploaded','type' => 'success'];
        $this->dispatch('toast', $message);
    }

    public function destroy()
    {
        User::where('id', Auth::user()->id)->delete();
        return redirect()->to('/home');
    }
}
