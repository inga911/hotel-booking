<style>
    .login-container {
        display: flex;
        height: 97vh;
        align-items: center;
        gap: 2em;
        box-sizing: border-box;
        margin-left: 5%
    }

    .login-image {
        height: 50%;
        width: 50%;
        top: 10em;
        left: 4em;
        z-index: 0;
        opacity: 0.9;
    }

    .login-form {
        width: 35%;
        line-height: 3em;
    }

    .login-label-input {
        display: grid;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: small;

    }

    .login-buttons {
        display: flex;
        justify-content: space-between;
        line-height: 2em;
        margin-top: 1em;
    }

    .login-input {
        padding: 0.7em;
        border: 1px solid #ccc;
        border-radius: 0.5em;
        width: 100%;
        font-size: small;
    }

    .login-link {
        color: #a7abda;
    }

    .login-link:hover {
        color: #414575;
    }

    .login-btn {
        padding: 0.5em 2.5em;
        text-transform: uppercase;
        font-size: small;
        letter-spacing: 1px;
        background-color: #F1DCF7;
        border: none;
        border-radius: 0.3em;
    }

    .login-btn:hover {
        background-color: #ff980091;
        cursor: pointer;
        scale: 1.05;
        transition: ease-in-out 0.1s;
    }


    @media (max-width: 900px) {
        .login-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-left: 5%;
        }

        .login-image {
            position: relative;
            width: 100%;
            top: 3em;
            left: 0;
            z-index: 0;
            opacity: 0.9;
        }

        .login-form {
            width: 80%;
            max-width: 400px;
            margin-top: 1em;
            position: relative;
            padding: 1em;
        }


        .login-label-input {
            display: grid;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: small
        }

        .label {
            line-height: 2em;
        }

    }

    .password-input-container {
        display: flex;
        align-items: center;
    }

    .password-visibility {
        cursor: pointer;
        margin-left: -3em;
        width: 1.5em;
    }
</style>
{{-- <x-guest-layout> --}}
<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />
<div class="login-container">


    <img src="{{ asset('/upload') . '/' . 'undraw_mobile_login_re_9ntv.svg' }}" class="login-image" alt="Login">

    <div class="login-form">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Login -->
            <div class="login-label-input">
                <x-input-label for="login" :value="__('Email/ Name/ Phone')" />
                <x-text-input id="login" class="login-input block mt-1 w-full @error('login') is-invalid @enderror"
                    type="text" name="login" :value="old('login')" required autofocus autocomplete="username" />
                @error('login')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <!-- Password -->
            <div class="login-label-input">
                <x-input-label for="password" :value="__('Password')" />
                <div class="password-input-container">
                    <x-text-input id="password" class="login-input password-input block mt-1 w-full" type="password"
                        name="password" required autocomplete="new-password" />

                    <img width="" height="" class="toggle-password-icon password-visibility"
                        onclick="togglePasswordVisibility('password')" src="https://img.icons8.com/ios/50/hide.png"
                        alt="visible--v1" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="login-buttons">

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="login-link" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
            </div>
            <div class="login-buttons">

                <div>
                    <x-primary-button class="login-btn">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
                <div>
                    Not a Member?
                    <a class="login-link" href="{{ route('register') }}">
                        {{ __('Sign Up') }}
                    </a>
                </div>

            </div>
        </form>
    </div>
</div>
{{-- </x-guest-layout> --}}
<script>
    function togglePasswordVisibility(inputId) {
        var passwordInput = document.getElementById(inputId);
        var toggleIcon = document.querySelector('#' + inputId + ' ~ .password-visibility');

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.src = "https://img.icons8.com/ios/50/visible--v1.png";
        } else {
            passwordInput.type = "password";
            toggleIcon.src = "https://img.icons8.com/ios/50/hide.png";
        }
    }
</script>
