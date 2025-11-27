    

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
        <h1>LogIn</h1>
<form method="POST" id="login-form" action="{{ route('login') }}" style="width: 100%; display: flex; flex-direction: column;">
    @csrf
    <!-- Username Field -->
    <div style="margin-bottom: 0.5rem; position: relative;">
        <input id="username" class="form-control @error('UserName') is-invalid @enderror"
            type="text"
            placeholder="Username"
            name="UserName"
            value="{{ old('UserName') }}"
            autocomplete="UserName"
            autofocus
            style="width: 100%; padding: 0.5rem; font-size: 0.875rem; background-color: #1e1e1e; color: #fff; border: 1px solid #444; border-radius: 0; outline: none; box-sizing: border-box;">
        @error('UserName')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div style="margin-bottom: 0.5rem; position: relative;">
        <input id="password" type="password" name="password" required placeholder="Password"
            style="width: 100%; padding: 0.5rem 2rem 0.5rem 0.5rem; font-size: 0.875rem; background-color: #1e1e1e; color: #fff; border: 1px solid #444; border-radius: 0; outline: none; box-sizing: border-box;">
        
        <span class="toggle-password" data-target="password"
        style="position: absolute; right: 0.5rem; top: 50%; transform: translateY(-50%); cursor: pointer; color: #aaa; font-size: 10px;">
        <i class="fas fa-eye-slash"></i>
    </span>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <!-- Submit Button -->
    <button type="submit"
        style="width: 100%; padding: 0.5rem; font-size: 0.875rem; background-color: #0dcaf0; color: #000; border: none; border-radius: 0; cursor: pointer;">
        Login
    </button>
</form>
        

        
    </div>

    
</body>

</html>
