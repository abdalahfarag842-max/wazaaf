<x-guest-layout>
   
    <div class="form-container">
        <div class="logo-container"> Forgot Password</div>

        @if (session('status'))
            <p class="success-msg"> {{ session('status') }}</p>
        @endif

        <form class="form" method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    required
                >
                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <button class="form-submit-btn" type="submit">Send Reset Link</button>
        </form>

        <p class="signup-link">
            Remember your password?
            <a href="{{ route('login') }}" class="link">Sign in</a>
        </p>
    </div>
</x-guest-layout>