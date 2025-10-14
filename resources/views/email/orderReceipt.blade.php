<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Receipt</title>
</head>
<body style="font-family: sans-serif;">
   <h2>Hi {{ $order->address->first_name ?? 'Customer' }},</h2>
<p>Thank you for your purchase!</p>

<h4>Order Summary:</h4>
<ul>
    @foreach($order->items as $item)
        <li>
            {{ $item->product->name ?? 'Product' }} x {{ $item->quantity }} — ${{ number_format($item->total_amount, 2) }}
        </li>
    @endforeach
</ul>

<p><strong>Total:</strong> ${{ number_format($order->grand_total, 2) }}</p>
<p><strong>Payment ID:</strong> {{ $order->stripe_payment_id }}</p>

<p>We hope you enjoy your purchase!<br>— {{ config('app.name') }} Team</p>

</body>
</html>
