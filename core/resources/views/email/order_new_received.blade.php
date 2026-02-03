<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            text-align: center;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .order-table th, .order-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .order-table th {
            background-color: #283a08;
            color: white;
            text-transform: uppercase;
        }

        .order-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .order-summary {
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: right;
            color: #283a08;
        }

        .thank-you {
            margin-top: 20px;
            text-align: center;
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <h2>🎉 New Order Received!</h2>
        <p>A new order has been placed with the following details:</p>

        <table class="order-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderDetails as $detail)
                <tr>
                    <td>{{ $detail->product->name }}</td>
                    <td>${{ number_format($detail->product->price, 2) }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>${{ number_format($detail->product->price * $detail->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p class="order-summary">Grand Total: ${{ number_format($order->orderDetails->sum(fn($d) => $d->product->price * $d->quantity), 2) }}</p>

        <p class="thank-you">Thank you for your order! 🚀</p>
    </div>

</body>
</html>
