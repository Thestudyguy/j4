<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Our Clinic</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f6f8; padding: 20px; color: #333;">

    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; padding: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">

        <h2 style="color: #2a9d8f; text-align: center;">
            Welcome, {{ $firstname }} {{ $lastname }}!
        </h2>

        <p>We’re happy to let you know that your patient account has been successfully created.</p>

        <p>You can now log in to your patient portal using the information below:</p>

        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
    <tr>
        <td style="padding: 10px; background-color: #f1f1f1;"><strong>Username:</strong></td>
        <td style="padding: 10px;">{{ $username }}</td>
    </tr>
    <tr>
        <td style="padding: 10px; background-color: #f1f1f1;"><strong>Password:</strong></td>
        <td style="padding: 10px;">{{ $password }}</td>
    </tr>
</table>

        <p><strong>Security Reminder:</strong> Please change your password after logging in for the first time.</p>

        <div style="margin-top: 30px; text-align: center;">
            <a href="{{ $loginUrl }}" 
               style="display: inline-block; background-color: #2a9d8f; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px;">
                Go to Login
            </a>
        </div>

        <p style="margin-top: 40px; opacity: .6;">This is an automated email. Please do not reply.</p>

        <p style="color: #999;">— Your Clinic Team</p>
    </div>

</body>
</html>
