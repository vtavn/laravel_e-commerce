<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\ProductAttribute;

class AdminEditAttributesComponent extends Component
{
    public $name, $attribute_id; 
    
    public function mount($attribute_id)
    {
        $pattribute = ProductAttribute::find($attribute_id);
        $this->product_attribute_id = $pattribute->id;
        $this->name = $pattribute->name;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,
        [
            'name' => 'required'
        ]);
        
    }

    public function updateAttributes()
    {
        $this->validate(
            [
                'name' => 'required'
            ]
        );

        $pattributes = ProductAttribute::find($this->attribute_id);
        $pattributes->name = $this->name;
        $pattributes->save();
        session()->flash('message', 'Attributes has been updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-attributes-component')->layout('layouts.base');
    }
}
