<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your Verification Code</title>

    <style>
        body {
            background: #f4f6f8;
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        .email-wrapper {
            width: 100%;
            padding: 40px 0;
            display: flex;
            justify-content: center;
        }

        .email-container {
            background: #ffffff;
            width: 100%;
            max-width: 550px;
            padding: 35px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        h1 {
            margin-top: 0;
            font-size: 26px;
            font-weight: 700;
            color: #333;
        }

        p {
            font-size: 15px;
            color: #555;
            line-height: 1.6;
        }

        .code-box {
            margin: 30px 0;
            padding: 18px 25px;
            background: #f1f5ff;
            border-left: 6px solid #3b82f6;
            font-size: 32px;
            font-weight: 800;
            letter-spacing: 6px;
            color: #1e3a8a;
            text-align: center;
            border-radius: 6px;
        }

        .footer {
            margin-top: 35px;
            text-align: center;
            font-size: 13px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-container">

            <h1>Hello {{ $firstname }} {{ $lastname }},</h1>

            <p>
                We received a request to verify your account.  
                Please enter the verification code below to continue.
            </p>

            <div class="code-box">
                {{ $vcodeInMyAnus }}
            </div>

            <p>
                If you did not request this, you can safely ignore this email.
            </p>

            <div class="footer">
                © {{ date('Y') }} YourAppName — All rights reserved.
            </div>

        </div>
    </div>
</body>
</html>
