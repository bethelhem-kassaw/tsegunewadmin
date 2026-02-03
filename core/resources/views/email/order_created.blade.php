<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h2>Thank you for your order, {{ $order->name }}!</h2>
    <p>Your order #{{ $order->orderId }} has been successfully placed.</p>
    <p>Order Total: ${{ $order->payment->amount }}</p>
    <p>We will notify you once your order is shipped.</p>
</body>
</html>
