<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;

class AdminEditCouponComponent extends Component
{
    public $code, $type, $value, $cart_value, $coupon_id, $expiry_date;

    public function mount($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        $this->code = $coupon->code;
        $this->type = $coupon->type;
        $this->value = $coupon->value;
        $this->cart_value = $coupon->cart_value;
        $this->coupon_id = $coupon->id;
        $this->expiry_date = $coupon->expiry_date;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,
            [
                'code' => 'required|unique:coupons,code',
                'type' => 'required',
                'value' => 'required|numeric',
                'cart_value' => 'required|numeric',
                'expiry_date' => 'required'
            ]
        );
    }

    public function updateCoupon()
    {
        $coupon = Coupon::find($this->coupon_id);

        $this->validate(
            [
                'code' => 'required|unique:coupons,code',
                'type' => 'required',
                'value' => 'required|numeric',
                'cart_value' => 'required|numeric',
                'expiry_date' => 'required'
            ]
        );

        $coupon->code = $this->code;
        $coupon->type = $this->type;
        $coupon->value = $this->value;
        $coupon->cart_value = $this->cart_value;
        $coupon->expiry_date = $this->expiry_date;
        $coupon->save();
        session()->flash('message', 'Coupon has been updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-coupon-component')->layout('layouts.base');
    }
}
