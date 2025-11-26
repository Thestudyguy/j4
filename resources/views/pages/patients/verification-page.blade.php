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
    background: whitesmoke;

    /* ✨ NEW cube/grid pattern */
    background-image:
        linear-gradient(#e2e8f0 1px, transparent 1px),
        linear-gradient(90deg, #e2e8f0 1px, transparent 1px);
    background-size: 40px 40px; /* size of each cube/grid */
    background-position: center;

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
      <div class="row w-100 justify-content-center">
                    <div class="loader-container verify-page" id="verify-page">
                    <div class="loader"></div>
                </div>
                </div>
    <div class="verify-container">
        <img src="{{ asset('images/dclogo.png') }}" alt="" width="150">
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
    const resendCooldownDefault = 60; // seconds
    let timerInterval = null;
    let loader = document.getElementById('verify-page');
    function startResendTimer(seconds = 60) {
        if (timerInterval) clearInterval(timerInterval);
        let timeLeft = seconds;
        resendLink.style.pointerEvents = 'none';
        resendLink.style.opacity = '0.5';
        timerDisplay.textContent = `(${timeLeft}s)`;

        timerInterval = setInterval(() => {
            timeLeft--;
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                timerInterval = null;
                timerDisplay.textContent = '';
                resendLink.style.pointerEvents = 'auto';
                resendLink.style.opacity = '1';
                return;
            }
            timerDisplay.textContent = `(${timeLeft}s)`;
        }, 1000);
    }

    resendLink.addEventListener('click', function (e) {
        e.preventDefault();

        // disable while waiting for response (prevents double clicks)
        resendLink.style.pointerEvents = 'none';
        resendLink.style.opacity = '0.5';

        fetch("{{ route('verification.resend') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({})
        })
        .then(async (response) => {
            const data = await response.json().catch(() => ({}));
            if (!response.ok) {
                // when blocked by cooldown, backend responds 429 and includes wait_time
                const wait = data.wait_time ?? resendCooldownDefault;
                alert(data.message ?? 'Unable to resend right now.');
                startResendTimer(wait);
                return;
            }

            // success path
            if (data.status === 'success') {
                alert(data.message || 'Verification code resent.');
                // start the timer using wait_time if provided
                const wait = data.wait_time ?? resendCooldownDefault;
                startResendTimer(wait);
                return;
            }

            // unexpected but handled
            const wait = data.wait_time ?? resendCooldownDefault;
            alert(data.message || 'Something went wrong.');
            startResendTimer(wait);
        })
        .catch((err) => {
            console.error('Resend fetch error:', err);
            alert('Something went wrong. Please try again.');
            // Put link back active (allow user to try)
            resendLink.style.pointerEvents = 'auto';
            resendLink.style.opacity = '1';
        });
    });
    </script>
</body>

</html>
