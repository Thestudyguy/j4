<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verify Your Email</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .verify-container {
            background: #ffffff;
            width: 100%;
            max-width: 420px;
            padding: 40px 35px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        h1 {
            margin: 0;
            font-size: 26px;
            color: #1e293b;
            font-weight: 700;
        }

        p {
            margin-top: 10px;
            font-size: 15px;
            color: #475569;
            line-height: 1.5;
        }

        .code-input {
            margin: 25px 0;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .code-input input {
            width: 50px;
            height: 55px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            border: 2px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            transition: all .25s;
        }

        .code-input input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px #93c5fd99;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            background: #2563eb;
            cursor: pointer;
            transition: background .3s ease;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        .resend {
            margin-top: 20px;
            color: #64748b;
            font-size: 14px;
        }

        .resend a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
            pointer-events: auto;
            opacity: 1;
        }

        .error {
            margin-top: 10px;
            color: #dc2626;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="verify-container">
        <h1>Email Verification</h1>
        <p>We sent a verification code to:<br><strong>{{ $email }}</strong></p>
        <p>Please enter the code below to continue.</p>

        <form method="POST" action="{{ route('new-user') }}">
            @csrf
            <div class="code-input">
                @for ($i = 0; $i < 6; $i++)
                    <input type="text" maxlength="1" name="code[]" required>
                @endfor
            </div>
            <input type="hidden" name="email" value="{{ $email }}">
            <button class="btn" type="submit">Verify</button>
        </form>

        <div class="resend">
            Didn’t get the code?
            <a href="#" id="resend-code">Resend Code</a>
            <span id="resend-timer" style="margin-left:5px;"></span>
        </div>
    </div>

    <script>
        const resendLink = document.getElementById('resend-code');
        const timerDisplay = document.getElementById('resend-timer');
        const resendCooldown = 60; // seconds
        let timerInterval;
        const inputs = document.querySelectorAll(".code-input input");

function startResendTimer(seconds = 60) {
    if (timerInterval) clearInterval(timerInterval); // <- clear previous timer
    let timeLeft = seconds;
    resendLink.style.pointerEvents = 'none';
    resendLink.style.opacity = '0.5';
    timerDisplay.textContent = `(${timeLeft}s)`;

    timerInterval = setInterval(() => {
        timeLeft--;
        timerDisplay.textContent = `(${timeLeft}s)`;
        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            timerDisplay.textContent = '';
            resendLink.style.pointerEvents = 'auto';
            resendLink.style.opacity = '1';
        }
    }, 1000);
}


        resendLink.addEventListener('click', function(e) {
            e.preventDefault();

            startResendTimer();

            fetch("{{ route('verification.resend') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                })
                .catch(() => {
                    alert('Something went wrong');
                });
        });

        // Auto-focus next input
        inputs.forEach((input, index) => {
            input.addEventListener("input", () => {
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });
            input.addEventListener("keydown", (e) => {
                if (e.key === "Backspace" && !input.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });
    </script>
</body>

</html>
