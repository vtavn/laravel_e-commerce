<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Carbon;

class AdminDashboardComponent extends Component
{
    public function render()
    {
        $orders = Order::orderBy('created_at','DESC')->get()->take(10);
        $totalSales = Order::where('status', 'delivered')->count();
        $totalRevenue = Order::where('status', 'delivered')->sum('total');
        $todaytotalSales = Order::where('status', 'delivered')->whereDate('created_at', Carbon::today())->count();
        $todaytotalRevenue = Order::where('status', 'delivered')->whereDate('created_at', Carbon::today())->sum('total');

        return view('livewire.admin.admin-dashboard-component', compact('orders', 'totalSales', 'totalRevenue', 'todaytotalSales', 'todaytotalRevenue'))->layout('layouts.base');
    }
}
