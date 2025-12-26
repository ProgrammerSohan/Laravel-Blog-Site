<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Changed</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f6f8;
            font-family: Arial, Helvetica, sans-serif;
        }
        .email-wrapper {
            width: 100%;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .email-header {
            background: #198754;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        .email-body {
            padding: 30px;
            color: #333333;
            line-height: 1.6;
        }
        .credentials {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
            font-size: 14px;
        }
        .credentials strong {
            display: inline-block;
            width: 120px;
        }
        .email-footer {
            text-align: center;
            font-size: 12px;
            color: #777777;
            padding: 15px;
            background: #f1f1f1;
        }

        @media (max-width: 600px) {
            .email-body {
                padding: 20px;
            }
            .credentials strong {
                width: 100%;
                display: block;
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>

<div class="email-wrapper">
    <div class="email-container">

        <div class="email-header">
            <h2>Password Changed Successfully</h2>
        </div>

        <div class="email-body">
            <p>Hello <strong>{{ $user->name }}</strong>,</p>

            <p>Your account password has been successfully changed. Below are your updated login details:</p>

            <div class="credentials">
                <p><strong>Email/Username:</strong> {{ $user->email }} or {{ $user->username}}</p>
             
                <p><strong>New Password:</strong> {{ $new_password }}</p>
            </div>

            <p>
                If you did not perform this action, please contact our support team immediately.
            </p>

          
        </div>

        <div class="email-footer">
            © {{ date('Y') }} Programmer Sohan. All rights reserved.
        </div>

    </div>
</div>

</body>
</html>
