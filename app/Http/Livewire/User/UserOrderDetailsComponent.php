<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserOrderDetailsComponent extends Component
{
    public $order_id;
    
    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    public function cancelOrder()
    {
        $order = Order::find($this->order_id);
        $order->status = "canceled";
        $order->canceled_date = Carbon::now();
        $order->save();
        session()->flash('order_message', 'Order has been cancelled.');
    }

    public function render()
    {
        $order = Order::where('user_id', Auth::user()->id)->where('id',$this->order_id)->first();

        return view('livewire.user.user-order-details-component', compact('order'))->layout('layouts.base');
    }
}
