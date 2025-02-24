<!DOCTYPE html>
<html>

<head>
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .header {
            text-align: center;
            background: #4CAF50;
            color: #fff;
            padding: 15px 0;
            border-radius: 10px 10px 0 0;
            font-size: 24px;
            font-weight: bold;
        }

        .content {
            font-size: 16px;
            color: #333;
            line-height: 1.8;
            padding: 20px;
        }

        .order-details {
            margin-top: 15px;
            padding: 15px;
            border: 1px solid #ddd;
            background: #fafafa;
            border-radius: 5px;
        }

        .order-details p {
            margin: 5px 0;
        }

        .order-details strong {
            color: #333;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #777;
            margin-top: 20px;
            padding: 15px;
            background: #eee;
            border-radius: 0 0 10px 10px;
        }

        ul {
            padding-left: 0;
        }

        ul li {
            background: #4CAF50;
            color: #fff;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            list-style: none;
            font-weight: bold;
        }

        .highlight {
            color: #d32f2f;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            {{ $orderDetails['user_name'] === "admin" ? "New Order Placed" : "Order Confirmation" }}
        </div>

        <div class="content">
            @if ($orderDetails['user_name'] === "admin")
                <p><strong>Hello Admin,</strong></p>
                <p class="highlight">A new order has been placed. Please review the details below:</p>
            @else
                <p><strong>Dear {{ $orderDetails['user_name'] }},</strong></p>
                <p>Thank you for your order! Here are your order details:</p>
            @endif

            <div class="order-details">
                <p><strong>Order ID(s):</strong> {{ implode(', ', $orderDetails['order_ids']) }}</p>
                <p><strong>Total Price:</strong> {{ convertPrice($orderDetails['total_amount']) }}</p>
                @if ($orderDetails['user_name'] === "admin")
                    <p><strong>Total Price:</strong> ₹{{ number_format($orderDetails['total_amount'], 2) }}</p>
                @endif
                <p><strong>Payment ID:</strong> {{ $orderDetails['payment_id'] }}</p>
                <p><strong>Payment Method:</strong> {{ $orderDetails['payment_method'] }}</p>

                @if ($orderDetails['user_name'] === "admin")
                                @php
                                    // Ensure shipping_address is properly decoded
                                    $shippingAddress = json_decode($orderDetails['shipping_address'], true);
                                @endphp

                                @if (is_array($shippingAddress))
                                    <strong>Shipping Address:</strong>
                                    <p>{{ $shippingAddress['country'] ?? 'N/A' }}</p>
                                    <p>{{ $shippingAddress['phone'] ?? 'N/A' }}</p>
                                    <p>{{ $shippingAddress['state'] ?? 'N/A' }}</p>
                                    <p>{{ $shippingAddress['zip_code'] ?? 'N/A' }}</p>
                                @else
                                    <p>Shipping address not available.</p>
                                @endif
                @endif




                <h4>Items Ordered:</h4>
                <ul>
                    @foreach ($orderDetails['order_items'] as $item)
                        <li>{{ $item['item_name'] }} - {{ $item['quantity'] }}</li>
                    @endforeach
                </ul>
            </div>

            @if ($orderDetails['user_name'] === "admin")
                <p class="highlight">Please check the admin panel for more details.</p>
            @else
                <p>We appreciate your business! If you have any questions, feel free to <a href="#"
                        style="color: #4CAF50; font-weight: bold;">contact us</a>.</p>
            @endif
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} PickleHouse. All rights reserved.
        </div>
    </div>
</body>

</html>