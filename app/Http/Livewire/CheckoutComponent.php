<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Mail\OrderMail;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Shipping;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Telegram\Bot\Laravel\Facades\Telegram;


class CheckoutComponent extends Component
{
    public $shipToDifferent;

    public $firstname, $lastname, $email, $phone, $address, $address_2, $city, $province, $country, $zipcode, $s_firstname, $s_lastname, $s_email, $s_phone, $s_address, $s_address_2, $s_city, $s_province, $s_country, $s_zipcode, $paymentMethod, $thankyou;

    public function updated($fields)
    {
        $this->validateOnly(
            $fields,
            [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email',
                'phone' => 'required|numeric',
                'address' => 'required',
                'address_2' => '',
                'city' => 'required',
                'province' => 'required',
                'country' => 'required',
                'zipcode' => 'required',
                'paymentMethod' => 'required'
            ]
        );

        if ($this->shipToDifferent) {
            $this->validateOnly(
                $fields,
                [
                    's_firstname' => 'required',
                    's_lastname' => 'required',
                    's_email' => 'required|email',
                    's_phone' => 'required|numeric',
                    's_address' => 'required',
                    's_address_2' => '',
                    's_city' => 'required',
                    's_province' => 'required',
                    's_country' => 'required',
                    's_zipcode' => 'required'
                ]
            );
        }
    }

    public function placeOrder()
    {
        $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'address_2' => '',
            'city' => 'required',
            'province' => 'required',
            'country' => 'required',
            'zipcode' => 'required',
            'paymentMethod' => 'required'
        ]);
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->subtotal = session()->get('checkout')['subtotal'];
        $order->discount = session()->get('checkout')['discount'];
        $order->tax = session()->get('checkout')['tax'];
        $order->total = session()->get('checkout')['total'];
        $order->firstname = $this->firstname;
        $order->lastname = $this->lastname;
        $order->email = $this->email;
        $order->phone = $this->phone;
        $order->address = $this->address;
        $order->address_2 = $this->address_2;
        $order->city = $this->city;
        $order->province = $this->province;
        $order->country = $this->country;
        $order->zipcode = $this->zipcode;
        $order->status = 'ordered';
        $order->is_shipping_different = $this->shipToDifferent ? 1 : 0;
        $order->save();

        foreach (Cart::instance('cart')->content() as $item) {
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;
            if($item->options)
            {
                $orderItem->options = serialize($item->options);
            }
            $orderItem->save();
        }

        if ($this->shipToDifferent) {
            $this->validate([
                's_firstname' => 'required',
                's_lastname' => 'required',
                's_email' => 'required|email',
                's_phone' => 'required|numeric',
                's_address' => 'required',
                's_address_2' => '',
                's_city' => 'required',
                's_province' => 'required',
                's_country' => 'required',
                's_zipcode' => 'required'
            ]);

            $shipping = new Shipping();
            $shipping->order_id = $order->id;
            $shipping->firstname = $this->s_firstname;
            $shipping->lastname = $this->s_lastname;
            $shipping->email = $this->s_email;
            $shipping->phone = $this->s_phone;
            $shipping->address = $this->s_address;
            $shipping->address_2 = $this->s_address_2;
            $shipping->city = $this->s_city;
            $shipping->province = $this->s_province;
            $shipping->country = $this->s_country;
            $shipping->zipcode = $this->s_zipcode;
            $shipping->save();
        }

        if ($this->paymentMethod == 'cod') {
            $transaction = new Transaction();
            $transaction->user_id = Auth::user()->id;
            $transaction->order_id = $order->id;
            $transaction->mode = 'cod';
            $transaction->status = 'pending';
            $transaction->save();
        }
        $this->thankyou = 1;
        Cart::instance('cart')->destroy();
        //send mail
        $this->sendOrderConfirmationMail($order);

//        Cấu hình send telegram
        $countProduct = $order->orderItems->count();
        $subTotal = number_format($order->subtotal);
        $discount = number_format($order->discount);
        $tax = number_format($order->tax);
        $total = number_format($order->total);

        if($order->is_shipping_different)
        {
            $thongtinkhach = "<b>Thông tin người đặt</b>\n"
                ."Họ tên: <b>". $order->firstname ." ".$order->lastname ."</b>\n"
                ."Số điện thoại: <b>". $order->phone."</b>\n"
                ."Email: <b>". $order->email ."</b>\n"
                ."Địa chỉ : <b>". $order->address . " - (".$order->address_2.") "
                .$order->province . " - "
                .$order->city . " - "
                .$order->country ." - "
                .$order->zipcode. "</b>\n"
                ."-----------------------\n"
                ."<b>Địa chỉ gửi hàng</b>\n"
                ."Họ tên: <b>". $order->shipping->firstname ." ".$order->shipping->lastname ."</b>\n"
                ."Số điện thoại: <b>". $order->shipping->phone."</b>\n"
                ."Email: <b>". $order->shipping->email ."</b>\n"
                ."Địa chỉ : <b>". $order->shipping->address . " - (".$order->shipping->address_2.") "
                .$order->shipping->province . " - "
                .$order->shipping->city . " - "
                .$order->shipping->country ." - "
                .$order->shipping->zipcode. "</b>\n";
        }else{
            $thongtinkhach = "<b>Thông tin người đặt</b>\n"
                ."Họ tên: <b>". $order->firstname ." ".$order->lastname ."</b>\n"
                ."Số điện thoại: <b>". $order->phone."</b>\n"
                ."Email: <b>". $order->email ."</b>\n"
                ."Địa chỉ : <b>". $order->address . " - (".$order->address_2.") "
                .$order->province . " - "
                .$order->city . " - "
                .$order->country ." - "
                .$order->zipcode. "</b>\n";
        }

        $textTelegram = "<b>Đơn hàng mới</b>\n"
                        ."Lúc: <b>".Carbon::now()."</b>\n"
                        ."Mã đơn hàng: <b>#$order->id</b>\n"
                        ."Số sản phẩm: <b>$countProduct</b>\n"
                        ."Giảm giá: <b>$discount</b> vnđ\n"
                        ."Phí: <b>$tax</b> vnđ\n"
                        ."Tổng thanh toán: <b>$total</b> vnđ\n"
                        ."<b>---------------------</b>\n"
                        .$thongtinkhach;

        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHANNEL_ID', '1854587509'),
            'parse_mode' => 'HTML',
            'text' => $textTelegram
        ]);
        //end send telegram

        session()->forget('checkout');

    }


    public function sendOrderConfirmationMail($order) {
        Mail::to($order->email)->send(new OrderMail($order));
    }

    public function verifyForCheckout()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        } else if ($this->thankyou) {
            return redirect()->route('thankyou');
        } else if (!session()->get('checkout')) {
            return redirect()->route('product.cart');
        }
    }

    public function render()
    {
        $this->verifyForCheckout();
        return view('livewire.checkout-component')->layout('layouts.base');
    }
}
