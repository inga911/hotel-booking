<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500&display=swap');

    * {
        font-family: 'Montserrat', sans-serif;
    }

    body {
        background: #8288cf1c;
    }

    h1 {
        text-transform: uppercase;
        letter-spacing: 3px;
        color: #5b6096;
        font-size: clamp(22px, 4vw, 40px);
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

    .login-container {
        display: flex;
        height: 97vh;
        align-items: center;
        gap: 2em;
        box-sizing: border-box;
        flex-direction: column;
        justify-content: center;
    }

    .login-image {
        width: 30%;
        top: 10em;
        left: 4em;
        z-index: 0;
        opacity: 0.9;
    }

    .login-form {
        min-width: 30%;
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

    .register-error {
        font-size: 11px;
        list-style: none;
        line-height: 0em;
        margin-left: -3em;
        color: crimson;
    }

    .repeat-pasw {
        display: inline;
    }

    .pasw-rule {
        font-size: 11px;
        color: gray;
        letter-spacing: 1px;
        line-height: 1.5em;
    }

    .double-error {
        position: relative;
        top: 2em;
        left: 3em;
    }
</style>
<div class="login-container">
    <h1>Registration</h1>
    <div class="login-form">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="login-label-input">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="login-input block mt-1 w-full" type="text" name="name"
                    :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="register-error" />
            </div>

            <!-- Last Name -->
            <div class="login-label-input">
                <x-input-label for="last_name" :value="__('Last Name')" />
                <x-text-input id="last_name" class="login-input block mt-1 w-full" type="text" name="last_name"
                    :value="old('last_name')" required autofocus autocomplete="last_name" />
                <x-input-error :messages="$errors->get('last_name')" class="register-error" />
            </div>

            <!-- Email Address -->
            <div class="login-label-input">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="login-input block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="register-error" />
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

                <div class="pasw-rule">
                    At least 8 characters
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="login-label-input">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <div class="password-input-container">
                    <x-text-input id="password_confirmation" class="login-input block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />

                    <img width="" height="" class="toggle-password-icon password-visibility"
                        onclick="togglePasswordVisibility('password_confirmation')"
                        src="https://img.icons8.com/ios/50/hide.png" alt="visible--v1" />
                </div>

                <div class="pasw-rule">
                    At least 8 characters
                </div>
                @if ($errors->has('password'))
                    @foreach ($errors->get('password') as $error)
                        <span class="register-error double-error">{{ $error }}</span><br>
                    @endforeach
                @endif
            </div>
            <div class="login-buttons">
                <a class="login-link" href="{{ route('login') }}">
                    {{ __('Already registered? Log in') }}
                </a>

                <x-primary-button class="login-btn">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>

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
