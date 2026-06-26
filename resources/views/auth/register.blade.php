<x-guest-layout>
    

    <form method="POST" action="{{ route('register') }}" class="form">
        @csrf

        <p class="title">Register</p>
        <p class="message">Signup now and get full access to our app.</p>

        {{-- Name --}}
        <label>
            <input
                required
                placeholder=""
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="input"
                autofocus
                autocomplete="name"
            >
            <span>Name</span>
        </label>
        @error('name')
            <span class="error-msg">{{ $message }}</span>
        @enderror

        {{-- Email --}}
        <label>
            <input
                required
                placeholder=""
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="input"
                autocomplete="username"
            >
            <span>Email</span>
        </label>
        @error('email')
            <span class="error-msg">{{ $message }}</span>
        @enderror

        {{-- Password --}}
        <label>
            <input
                required
                placeholder=""
                type="password"
                name="password"
                class="input"
                autocomplete="new-password"
            >
            <span>Password</span>
        </label>
        @error('password')
            <span class="error-msg">{{ $message }}</span>
        @enderror

        {{-- Confirm Password --}}
        <label>
            <input
                required
                placeholder=""
                type="password"
                name="password_confirmation"
                class="input"
                autocomplete="new-password"
            >
            <span>Confirm password</span>
        </label>
        @error('password_confirmation')
            <span class="error-msg">{{ $message }}</span>
        @enderror

        {{-- Role --}}
        <label>
            <select name="role" class="input" required>
                <option value="user">User</option>
                <option value="employee">Employee</option>
                <option value="admin">Admin</option>
            </select>
          
        </label>
        @error('role')
            <span class="error-msg">{{ $message }}</span>
        @enderror

        <button type="submit" class="submit">Register</button>

        <p class="signin">
            Already have an account?
            <a href="{{ route('login') }}">Signin</a>
        </p>
    </form>
</x-guest-layout>