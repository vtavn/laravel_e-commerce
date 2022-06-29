<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class UserOrdersComponent extends Component
{
    use WithPagination;
    public function render()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(12);
        return view('livewire.user.user-orders-component', compact('orders'))->layout('layouts.base');
    }
}
