<!DOCTYPE html>
<html>

<head>
    <title>Newsletter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #eee;
        }

        .email-header img {
            max-width: 150px;
        }

        .email-body {
            padding: 20px 0;
            text-align: center;
        }

        .email-body h2 {
            color: #333;
            font-size: 24px;
        }

        .email-body p {
            color: #666;
            font-size: 16px;
            line-height: 1.6;
        }

        .cta-button {
            display: inline-block;
            background-color: #ff6600;
            color: #ffffff;
            padding: 12px 20px;
            margin-top: 15px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .cta-button:hover {
            background-color: #e65c00;
        }

        .email-footer {
            margin-top: 20px;
            padding-top: 20px;
            text-align: center;
            border-top: 2px solid #eee;
        }

        .email-footer p {
            font-size: 14px;
            color: #888;
        }

        .social-icons {
            margin-top: 10px;
        }

        .social-icons a {
            display: inline-block;
            margin: 0 5px;
            font-size: 20px;
            color: #ff6600;
            text-decoration: none;
        }

        .social-icons a:hover {
            color: #e65c00;
        }
    </style>
</head>

<body>

    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <img src="{{ config('app.url') }}/img/logo.png" alt="Company Logo">

        </div>

        <!-- Body -->
        <div class="email-body">
            <h2>🌟 Latest News & Special Offers! 🌟</h2>
            <p>{{ $messageContent }}</p>

            <!-- Call to Action Button -->
            <a href="{{ url('/') }}" class="cta-button">Shop Now</a>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>Follow us on social media</p>
            <div class="social-icons">
                <a href="#"><i class="fas fa-facebook"></i></a>
                <a href="#"><i class="fas fa-twitter"></i></a>
                <a href="#"><i class="fas fa-instagram"></i></a>
                <a href="#"><i class="fas fa-linkedin"></i></a>
            </div>
            <p>&copy; 2025 PickleHouse. All Rights Reserved.</p>
        </div>
        <div class="email-footer">
            <p>If you no longer wish to receive our emails, you can <a
                    href="{{ url('/newsletter/unsubscribe/' . $unsubscribe_token) }}"
                    style="color: red; text-decoration: underline;">unsubscribe here</a>.</p>
        </div>

    </div>

</body>

</html>