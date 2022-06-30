<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserEditProfileComponent extends Component
{
    use WithFileUploads;

    public $name, $phone, $email, $address, $address_2, $city, $country, $province, $zipcode, $image, $newimage;

    public function mount()
    {
        $user = User::find(Auth::user()->id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->image = $user->profile->image;
        $this->address = $user->profile->address;
        $this->address_2 = $user->profile->address_2;
        $this->city = $user->profile->city;
        $this->country = $user->profile->country;
        $this->province = $user->profile->province;
        $this->zipcode = $user->profile->zipcode;
    }

    public function updateProfile() {
        $user = User::find(Auth::user()->id);
        $user->name = $this->name;
        $user->save();

        $user->profile->phone = $this->phone;
        if($this->newimage)
        {
            if($this->image)
            {
                unlink('assets/images/profile/'.$this->image);
            }
            $imageName = Carbon::now()->timestamp. '.' . $this->newimage->extension();
            $this->newimage->storeAs('profile', $imageName);
            $user->profile->image = $imageName;
            
        }
        $user->profile->address = $this->address;
        $user->profile->address_2 = $this->address_2;
        $user->profile->city = $this->city;
        $user->profile->province = $this->province;
        $user->profile->zipcode = $this->zipcode;
        $user->profile->country = $this->country;
        $user->profile->save();
        session()->flash('message', 'Profile has been updated successfully.');

    }

    public function render()
    {
        return view('livewire.user.user-edit-profile-component')->layout('layouts.base');
    }
}
