<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0; padding:0; background-color:#f4f6f8; font-family: Arial, Helvetica, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f8; padding:20px;">
    <tr>
        <td align="center">

            <!-- Email Container -->
            <table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px; background:#ffffff; border-radius:8px; overflow:hidden;">
                
                <!-- Header -->
                <tr>
                    <td style="background:#0d6efd; padding:20px; text-align:center; color:#ffffff;">
                        <h2 style="margin:0;">Reset Your Password</h2>
                    </td>
                </tr>

                <!-- Body -->
                <tr>
                    <td style="padding:30px; color:#333333;">
                        <p style="font-size:16px; margin:0 0 15px;">
                            Hello, {{ $user->name }}
                        </p>

                        <p style="font-size:15px; line-height:1.6; margin:0 0 20px;">
                            We received a request to reset your password. Click the button below to set a new password.
                        </p>

                        <!-- Button -->
                        <div style="text-align:center; margin:30px 0;">
                            <a href="{{ $actionlink }}" target="_blank"
                               style="background:#0d6efd; color:#ffffff; text-decoration:none; padding:12px 25px; border-radius:5px; font-size:16px; display:inline-block;">
                                Reset Password
                            </a>
                        </div>

                        <p style="font-size:14px; color:#666666; line-height:1.6;">
                            If you didn’t request a password reset, please ignore this email.
                        </p>

                        <p style="font-size:14px; color:#666666; margin-top:20px;">
                            This link will expire in 60 minutes.
                        </p>

                        <p style="font-size:14px; margin-top:30px;">
                            Thanks,<br>
                            <strong>Your App Team</strong>
                        </p>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="background:#f1f1f1; padding:15px; text-align:center; font-size:13px; color:#777777;">
                        © {{ date('Y') }} Programmer. All rights reserved.
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>
