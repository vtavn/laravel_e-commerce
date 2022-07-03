<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\ProductAttribute;

class AdminAddAttributesComponent extends Component
{
    public $name; 
    
    public function updated($fields)
    {
        $this->validateOnly($fields,
        [
            'name' => 'required'
        ]);
        
    }

    public function storeAttributes()
    {
        $this->validate(
            [
                'name' => 'required'
            ]
        );
        $pattributes = new ProductAttribute();
        $pattributes->name = $this->name;
        $pattributes->save();
        session()->flash('message', 'Attributes has been created successfully.');
    }

    public function render()
    {
        return view('livewire.admin.admin-add-attributes-component')->layout('layouts.admin');
    }
}
