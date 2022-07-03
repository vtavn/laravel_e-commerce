<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Order confirmation</title>
</head>
<body>
  <p>Hi {{$order->firstname}} {{$order->lastname}}</p>
  <p>{{ __('Your order has been successfully placed') }}.</p>
  <table style="width:600px; text-align:center;">
    <thead>
      <tr>
        <th>{{ __('Ảnh') }}</th>
        <th>{{ __('Tên Sản Phẩm') }}</th>
        <th>{{ __('Số lượng') }}</th>
        <th>{{ __('Đơn giá') }}</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($order->orderItems as $item)
        <tr>
          <td><img src="{{asset('assets/images/products')}}/{{ $item->product->image}}" width="100" alt=""/></td>
          <td>{{ $item->product->name}}</td>
          <td>{{ $item->quantity}}</td>
          <td>{{ number_format($item->price * $item->quantity)}}{{ __('$') }}</td>
        </tr>
      @endforeach
      <tr>
        <td colspan="3" style="border-top:1px solid #ccc"></td>
        <td style="font-size:15px; font-weight:bold; ">Tạm tính : {{number_format($order->subtotal)}}{{ __('$') }}</td>
      </tr>
      <tr>
        <td colspan="3"></td>
        <td style="font-size:15px; font-weight:bold;">Giảm giá : {{number_format($order->discount)}}{{ __('$') }}</td>
      </tr>
      <tr>
        <td colspan="3"></td>
        <td style="font-size:15px; font-weight:bold;">Phí : {{number_format($order->tax)}}{{ __('$') }}</td>
      </tr>
      <tr>
        <td colspan="3"></td>
        <td style="font-size:15px; font-weight:bold;">Thanh toán : {{number_format($order->total)}}{{ __('$') }}</td>
      </tr>
    </tbody>
  </table>
</body>
</html>
