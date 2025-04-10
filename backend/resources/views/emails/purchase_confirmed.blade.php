<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Purchase Successful</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f6f8;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        .header {
            background-color: #ffffff;
            padding: 30px 20px 10px;
            text-align: center;
        }
        .logo {
            max-width: 120px;
            margin: 0 auto;
        }
        .content {
            padding: 30px 25px;
            line-height: 1.6;
        }
        .content h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
        }
        .car-image {
            display: block;
            margin: 25px auto;
            max-width: 100%;
            border-radius: 8px;
        }
        .car-details {
            list-style: none;
            padding: 0;
            margin: 20px 0;
            text-align: center;
        }
        .car-details li {
            /* margin: 10px 0; */
            font-size: 16px;
        }
        .footer {
            text-align: center;
            font-size: 15px;
            color: #888;
            padding: 20px 25px 30px;
            background-color: #f9f9f9;
            border-top: 1px solid #eee;
        }
        .footer strong {
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img class="logo" src="https://app.teslastocksdigital.com/public/assets/images/tesla_logo.png" alt="Tesla Stocks Digital Logo">
        </div>

        <!-- Message Content -->
        <div class="content">
            <h2>Purchase Successful</h2>
            <p>Hello <strong>{{ $purchase->fullname }}</strong>,</p>
            <p>Thank you for your recent purchase! We're excited to confirm that your order has been successfully processed. Below are the details of the Tesla vehicle you purchased:</p>

            <img class="car-image" src="{{ 'https://app.teslastocksdigital.com/public/car_images/' . $carInfo->car_img }}" alt="Tesla Car Image">

            <ul class="car-details" style="text-align: left;">
                <li><strong>Model:</strong> {{ $carInfo->model }}</li>
                <li><strong>Year:</strong> {{ $carInfo->year }}</li>
                <li><strong>Price:</strong> ${{ number_format($carInfo->price, 2) }}</li>
            </ul>

            <p>Our logistics team will be in touch shortly to provide you with shipping and delivery information. Please make sure your contact details are accurate to avoid any delays.</p>

            <p>If you have any questions or need assistance, our support team is here to help.</p>

            <p style="text-align: center; margin-top: 30px;">
                Thank you for choosing <strong style="color: #e74c3c;">TESLA STOCKS DIGITAL</strong>!
            </p>
            <p style="text-align: center; margin-top: 10px;">
                Sincerely,<br>
                <strong style="color: #2c3e50;">TESLA STOCKS DIGITAL</strong>
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            &copy; {{ date('Y') }} Tesla Stocks Digital. All rights reserved.
        </div>
    </div>
</body>
</html>
