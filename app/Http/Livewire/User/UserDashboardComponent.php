<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserDashboardComponent extends Component
{
    public function render()
    {
        $orders = Order::orderBy('created_at', 'DESC')->where('user_id', Auth::user()->id)->get()->take(10);
        $totalCost = Order::where('status', '!=', 'canceled')->where('user_id', Auth::user()->id)->sum('total');
        $totalPurchase = Order::where('status', '!=', 'canceled')->where('user_id', Auth::user()->id)->count();
        $totalDeliverd = Order::where('status', 'delivered')->where('user_id', Auth::user()->id)->count();
        $totalCanceled = Order::where('status', 'canceled')->where('user_id', Auth::user()->id)->count();
        return view('livewire.user.user-dashboard-component', compact('orders','totalCost','totalPurchase','totalDeliverd','totalCanceled'))->layout('layouts.base');
    }
}
