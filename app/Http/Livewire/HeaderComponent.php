<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;

class HeaderComponent extends Component
{
    public function render()
    {
        $setting = Setting::find(1);
        return view('livewire.header-component', compact('setting'));
    }
}
