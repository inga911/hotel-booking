<style>
    * {
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    .forgot-pasw-container {
        display: flex;
        height: 97vh;
        align-items: center;
        gap: 2em;
        box-sizing: border-box;
        margin-left: 5%;
    }

    .forgot-pasw-img {
        width: 45%;
        height: 95vh;
    }

    .forgot-pasw-image {
        position: relative;
        width: 100%;
        top: 10em;
        left: 13em;
        z-index: 0;
        opacity: 0.9;
    }

    .forgot-pasw-form {
        width: 35%;
        line-height: 3em;
        z-index: 5;
    }

    .forgot-pasw-label-input {
        display: grid;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: medium;
    }

    .forgot-pasw-input {
        padding: 0.7em;
        border: 1px solid #ccc;
        border-radius: 0.5em;
    }

    .forgot-text {
        line-height: 2em;
        margin-top: 8em;
    }

    .forgot-btn {
        margin-top: 3em;
        border-radius: 0.3em;
        border: 1px solid black;
        padding: 0.5em;
        background: transparent;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: smaller;
        font-weight: 500;
    }

    .forgot-btn:hover {
        border-color: #42d0ca;
        color: #42d0ca;
        cursor: pointer;
    }

    @media(max-width:900px) {
        .forgot-pasw-container {
            display: block;
        }

        .forgot-pasw-image {
            width: 60%;
            position: absolute;
            height: 34%;
            top: 8em;
            left: 15%;
        }

        .forgot-pasw-img {
            margin: 0;
            width: 100%;
        }

        .forgot-pasw-form {
            position: absolute;
            left: 15%;
            width: 70%;
            top: 48%;
        }

        .forgot-pasw-buttons {
            flex-wrap: wrap
        }

        .forgot-text {
            margin-top: 3em;
        }
    }
</style>
<div class="forgot-pasw-container">

    <div class="forgot-pasw-img">
        <img src="{{ asset('/upload') . '/' . 'undraw_forgot_password_re_hxwm.svg' }}" class="forgot-pasw-image"
            alt="Forgot Password">
    </div>
    <div class="forgot-pasw-form">
        <div class="forgot-text">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="forgot-pasw-label-input">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="forgot-pasw-input block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-primary-button class="forgot-btn">
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
