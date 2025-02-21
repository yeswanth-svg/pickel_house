<!DOCTYPE html>
<html>

<head>
    <title>Order Status Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding: 10px 0;
        }

        .logo {
            max-width: 150px;
        }

        .content {
            font-size: 16px;
            color: #333;
            line-height: 1.6;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #777;
            margin-top: 20px;
        }

        .order-details {
            margin-top: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            background: #f9f9f9;
            border-radius: 5px;
        }

        .order-details p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('img/logo2.png') }}" alt="PickleHouse Logo" class="me-2 img-fluid"
                style="max-width: 100px; max-height: 100px;">
        </div>

        <div class="content">
            <p>Dear {{ $order->user->name }},</p>

            <p>Your order status has been updated to:
                <strong>{{ ucfirst(str_replace('_', ' ', $order->order_stage)) }}</strong>.
            </p>

            <div class="order-details">
                <p><strong>Order ID:</strong> {{ $order->id }}</p>
                <p><strong>Dish Ordered:</strong> {{ $order->dish->name }}</p>
                <p><strong>No Of Items:</strong> {{ $order->cart_quantity }}</p>
                <p><strong>Quantity:</strong> {{ $order->quantity->weight }}</p>
                <p><strong>Total Price:</strong>
                    {{ convertPrice(($order->total_amount + $order->shipping_cost) - $order->coupon_discount) }}
                </p>

            </div>

            <p>Thank you for choosing our service. If you have any questions, feel free to contact us.</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
        </div>
    </div>
</body>

</html>