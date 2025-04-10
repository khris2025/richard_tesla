<!DOCTYPE html>
<html>
<head>
    <title>Withdrawal Notification</title>
    <style>
        /* Add your email styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
           
            margin: 0 auto;
            padding: 5px;
        }
        .logo {
            max-width: 150px;
            display: block;
            margin: 0 auto;
        }
        .message {
            padding: 5px;
            background-color: #ffffff;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img class="logo" src="https://app.teslastocksdigital.com/public/assets/images/tesla_logo.png" alt="Company Logo">
        <div class="message">
            <h2>Withdrawal Declined</h2>
            <p>Hello {{ $user->name }},</p>
            <p>We regret to inform you that your withdrawal request of ${{ number_format($withdrawal_amount) }} has been declined.</p>
            <p>Please contact our support team for more information and assistance.</p>
            <p>Your account balance remains unchanged.</p>
            <p>Thank you for choosing our services!</p>
            <p>Sincerely,<br> TESLA STOCKS DIGITAL</p>
        </div>
    </div>
</body>
</html>