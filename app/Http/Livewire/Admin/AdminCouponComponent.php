<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCouponComponent extends Component
{
    use WithPagination;
    
    public function deleteCoupon($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        session()->flash('message', 'Coupon has been deleted successfully.');
    }

    public function render()
    {
        $coupons = Coupon::paginate(5);
        return view('livewire.admin.admin-coupon-component', compact('coupons'))->layout('layouts.base');
    }
}
