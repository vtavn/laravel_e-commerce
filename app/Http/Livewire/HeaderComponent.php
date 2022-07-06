<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;
use App\Models\Category;

class HeaderComponent extends Component
{
    public function render()
    {
        $setting = Setting::find(1);
        $cats = explode(',', $setting->header_category);
        $categories = Category::whereIn('id', $cats)->get();
        return view('livewire.header-component', compact('setting', 'categories'));
    }
}
