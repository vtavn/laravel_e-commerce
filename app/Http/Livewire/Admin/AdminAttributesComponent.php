<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProductAttribute;

class AdminAttributesComponent extends Component
{
    use WithPagination;

    public function deleteAttributes($id)
    {
        $pattribute = ProductAttribute::find($id);
        $pattribute->delete();
        session()->flash('message', 'Attribute has been deleted successfully.');
    }

    public function render()
    {
        $pattributes = ProductAttribute::paginate(10);
        return view('livewire.admin.admin-attributes-component', compact('pattributes'))->layout('layouts.base');
    }
}
