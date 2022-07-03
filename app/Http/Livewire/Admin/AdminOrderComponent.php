<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class AdminOrderComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function updateOrderStatus($order_id, $status)
    {
        $order = Order::find($order_id);
        $order->status = $status;
        if ($status == 'delivered') {
            $order->delivered_date = Carbon::now();
        } elseif ($status == 'canceled'){
            $order->canceled_date = Carbon::now();
        }
        $order->save();
        session()->flash('order_message', 'Order status has been updated successfully.');
    }

    public function render()
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate(12);
        return view('livewire.admin.admin-order-component', compact('orders'))->layout('layouts.admin');
    }
}
