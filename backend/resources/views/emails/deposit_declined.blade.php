<!DOCTYPE html>
<html>
<head>
    <title>Deposit Notification</title>
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
            <h2>Deposit Not Successful</h2>
            <p>Hello {{ $user->name }},</p>
            <p>We regret to inform you that the deposit of ${{ number_format($deposit_amount) }} to your account was not successful.</p>
            <p>Your account balance remains unchanged.</p>
            <p>Please feel free to contact our support if you have any questions or concerns.</p>
            <p>Sincerely,<br> TESLA STOCKS DIGITAL</p>
        </div>
    </div>
</body>
</html>