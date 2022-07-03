<?php

namespace App\Http\Livewire\Admin;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class AdminContactComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $contacts = Contact::paginate(12);
        
        return view('livewire.admin.admin-contact-component', compact('contacts'))->layout('layouts.admin');
    }
}
