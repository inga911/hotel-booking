<style>
    * {
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    .reset-pasw-container {
        display: flex;
        height: 97vh;
        align-items: center;
        gap: 2em;
        box-sizing: border-box;
        margin-left: 5%;
    }

    .reset-pasw-img {
        width: 45%;
        height: 95vh;
    }

    .reset-pasw-image {
        position: relative;
        width: 100%;
        top: 10em;
        z-index: 0;
        opacity: 0.9;
    }

    .reset-pasw-form {
        width: 35%;
        line-height: 3em;
        z-index: 5;
    }

    .reset-pasw-label-input {
        display: grid;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: medium;
    }

    .reset-pasw-input {
        padding: 0.7em;
        border: 1px solid #ccc;
        border-radius: 0.5em;
        width: 100%;
    }

    .reset-text {
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #f09b00;
        font-size: 1.5em;
    }

    .pasw-rule {
        font-size: 11px;
        color: gray;
        letter-spacing: 1px;
        line-height: 1.5em;
    }

    .reset-btn {
        margin-top: 3em;
        border-radius: 0.3em;
        border: 1px solid rgb(0, 0, 0);
        padding: 0.5em;
        background: transparent;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: smaller;
        font-weight: 500;
    }

    .reset-btn:hover {
        border-color: #eca10b;
        color: #eca10b;
        cursor: pointer;
    }

    .register-error {
        font-size: 11px;
        list-style: none;
        line-height: 0em;
        margin-left: -3em;
        color: crimson;
    }

    @media(max-width:900px) {
        .reset-pasw-container {
            display: block;
        }

        .reset-pasw-image {
            width: 60%;
            position: absolute;
            height: 34%;
            top: 8em;
            left: 15%;
        }

        .reset-pasw-img {
            margin: 0;
            width: 100%;
        }

        .reset-pasw-form {
            position: absolute;
            left: 15%;
            width: 70%;
            top: 48%;
        }

        .reset-pasw-buttons {
            flex-wrap: wrap
        }

        .reset-text {
            margin-top: 3em;
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
<div class="reset-pasw-container">

    <div class="reset-pasw-img">
        <img src="{{ asset('/upload') . '/' . 'undraw_secure_login_pdn4.svg' }}" class="reset-pasw-image"
            alt="Forgot Password">
    </div>
    <div class="reset-pasw-form">
        <div class="reset-text">
            {{ __('Reset your password') }}
        </div>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="reset-pasw-label-input">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="reset-pasw-input block mt-1 w-full" type="email" name="email"
                    :value="old('email', $request->email)" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="reset-pasw-label-input">
                <x-input-label for="password" :value="__('Password')" />

                <div class="password-input-container">
                    <x-text-input id="password" class="reset-pasw-input password-input block mt-1 w-full"
                        type="password" name="password" required autocomplete="new-password" />

                    <img class="toggle-password-icon password-visibility" onclick="togglePasswordVisibility('password')"
                        src="https://img.icons8.com/ios/50/hide.png" alt="visible--v1" />
                </div>

                <div class="pasw-rule">
                    At least 8 characters
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="reset-pasw-label-input">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <div class="password-input-container">
                    <x-text-input id="password_confirmation" class="reset-pasw-input block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />

                    <img class="toggle-password-icon password-visibility"
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


            <div>
                <x-primary-button class="reset-btn">
                    {{ __('Reset Password') }}
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
