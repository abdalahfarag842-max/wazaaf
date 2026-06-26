<x-guest-layout>
    <style>
        .form-container {
            max-width: 400px;
            background-color: #fff;
            padding: 32px 24px;
            font-size: 14px;
            font-family: inherit;
            color: #212121;
            display: flex;
            flex-direction: column;
            gap: 20px;
            box-sizing: border-box;
            border-radius: 10px;
            box-shadow: 0px 0px 3px rgba(0,0,0,0.084), 0px 2px 3px rgba(0,0,0,0.168);
        }
        .form-container .logo-container {
            text-align: center;
            font-weight: 600;
            font-size: 18px;
        }
        .form-container .info-text {
            text-align: center;
            color: #555;
            line-height: 1.6;
        }
        .form-container .success-text {
            text-align: center;
            color: green;
            font-weight: 500;
        }
        .form-container .form-submit-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: inherit;
            color: #fff;
            background-color: #212121;
            border: none;
            width: 100%;
            padding: 12px 16px;
            font-size: inherit;
            gap: 8px;
            cursor: pointer;
            border-radius: 6px;
            box-shadow: 0px 0px 3px rgba(0,0,0,0.084), 0px 2px 3px rgba(0,0,0,0.168);
        }
        .form-container .form-submit-btn:hover { background-color: #313131; }
        .form-container .form-submit-btn:active { scale: 0.95; }
        .form-container .link {
            color: #1778f2;
            text-decoration: none;
            font-weight: 500;
        }
        .form-container .link:hover { text-decoration: underline; }
        .form-container .logout-row {
            text-align: center;
        }
        .form-container .logout-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: #1778f2;
            font-size: 14px;
            font-family: inherit;
            text-decoration: none;
        }
        .form-container .logout-btn:hover { text-decoration: underline; }
    </style>

    <div class="form-container">
        <div class="logo-container">✉️ Verify Your Email</div>

        <p class="info-text">
            Thanks for signing up! Before getting started, please verify your email
            address by clicking the link we sent you.
        </p>

        @if (session('status') == 'verification-link-sent')
            <p class="success-text">
                 A new verification link has been sent to your email address.
            </p>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="form-submit-btn">
                Resend Verification Email
            </button>
        </form>

        <div class="logout-row">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Log Out</button>
            </form>
        </div>
    </div>
</x-guest-layout>