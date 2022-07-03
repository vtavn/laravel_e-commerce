<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\HomeSlider;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class AdminAddHomeSliderComponent extends Component
{
    use WithFileUploads;
    
    public $title, $subtitle, $price, $link, $status, $image;

    public function mount()
    {
        $this->status = 0;
        
    }

    public function addSlider()
    {
        $slider = new HomeSlider();
        $slider->title = $this->title;
        $slider->subtitle = $this->subtitle;
        $slider->price = $this->price;
        $slider->link = $this->link;
        $slider->status = $this->status;
        $imageName = Carbon::now()->timestamp. '.' . $this->image->extension();
        $this->image->storeAs('sliders', $imageName);
        $slider->image = $imageName;
        $slider->save();
        session()->flash('message', 'Slide has been created successfully.');
    }

    public function render()
    {
        return view('livewire.admin.admin-add-home-slider-component')->layout('layouts.admin');
    }
}
