<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>

    <!-- FontAwesome for Eye Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: whitesmoke;

            /* Grid background */
            background-image:
                linear-gradient(#e2e8f0 1px, transparent 1px),
                linear-gradient(90deg, #e2e8f0 1px, transparent 1px);
            background-size: 40px 40px;
            background-position: center;

            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .verify-container {
            background: white;
            width: 100%;
            max-width: 420px;
            padding: 40px 35px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.35);
            /* border: 1px solid #2e2e2e; */
        }

        h1 {
            margin: 0;
            margin-top: 10px;
            font-size: 26px;
            color: #000000;
            font-weight: 700;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            font-size: 0.9rem;
            background-color: #111;
            color: #fff;
            border: 1px solid #444;
            border-radius: 6px;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: #0dcaf0;
            box-shadow: 0 0 0 3px #00c8ff44;
            outline: none;
        }

        .input-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .toggle-password {
            position: absolute;
            right: 0.9rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #bbb;
            font-size: 1rem;
        }

        .toggle-password:hover {
            color: white;
        }

        button {
            width: 100%;
            padding: 0.7rem;
            font-size: 1rem;
            background-color: #0dcaf0;
            color: #000;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        button:hover {
            background-color: #0bb8d8;
        }

        img {
            filter: drop-shadow(0px 2px 4px rgba(0, 0, 0, 0.4));
        }
    </style>
</head>

<body>

    <div class="verify-container">
        <img src="{{ asset('images/dclogo.png') }}" alt="" width="150">

        <h1>Login</h1>

        <form method="POST" id="login-form" action="{{ route('login') }}"
            style="width: 100%; display: flex; flex-direction: column; margin-top: 20px;">
            @csrf

            <!-- Username -->
            <div class="input-group">
                <input id="username" class="form-control @error('UserName') is-invalid @enderror"
                    type="text" placeholder="Username" name="UserName"
                    value="{{ old('UserName') }}" autocomplete="UserName" autofocus>

                @error('UserName')
                <span class="invalid-feedback text-white" role="alert">
                    <strong class="text-white">{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <!-- Password -->
            <div class="input-group">
                <input id="password" type="password" name="password" required placeholder="Password"
                    class="form-control">

                <span class="toggle-password" data-target="password">
                    <i class="fa-solid fa-eye-slash"></i>
                </span>

                @error('password')
                <span class="invalid-feedback text-white" role="alert">
                    <strong class="text-white">{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <!-- Button -->
            <button type="submit">Login</button>
        </form>
    </div>


    <!-- Toggle Password Script -->
    <script>
        document.querySelectorAll(".toggle-password").forEach(icon => {
            icon.addEventListener("click", function () {
                let target = document.getElementById(this.dataset.target);
                let iconElement = this.querySelector("i");

                if (target.type === "password") {
                    target.type = "text";
                    iconElement.classList.remove("fa-eye-slash");
                    iconElement.classList.add("fa-eye");
                } else {
                    target.type = "password";
                    iconElement.classList.remove("fa-eye");
                    iconElement.classList.add("fa-eye-slash");
                }
            });
        });
    </script>

</body>

</html>
