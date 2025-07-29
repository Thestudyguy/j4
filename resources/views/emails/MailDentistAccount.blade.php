<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Created</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f6f8; padding: 20px; color: #333;">

    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; padding: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <h2 style="color: #2a9d8f; text-align: center;">Welcome Dr. {{ $doctor->FirstName }} {{ $doctor->LastName }}!</h2>

        <p>Your account has been created. You can log in using the details below:</p>

        <table style="width: 100%; margin-top: 20px; margin-bottom: 20px; border-collapse: collapse;">
            <tr>
                <td style="padding: 10px; background-color: #f1f1f1;"><strong>Username:</strong></td>
                <td style="padding: 10px;">{{ $username }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; background-color: #f1f1f1;"><strong>Password:</strong></td>
                <td style="padding: 10px;">{{ $password }}</td>
            </tr>
        </table>

        <p><strong>Important:</strong> For your security, please change your password immediately after your first login.</p>

        <div style="margin-top: 30px; text-align: center;">
            <a style="display: inline-block; background-color: #2a9d8f; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px;">Go to Login</a>
        </div>

        <!-- <p style="margin-top: 40px;">If you have any questions, feel free to reply to this email.</p> -->
<p style="margin-top: 40px; opacity: .6;">This is an automated email. Please do not reply to this message.</p>

        <p style="color: #999;">&mdash; The Admin Team</p>
    </div>

</body>
</html>
