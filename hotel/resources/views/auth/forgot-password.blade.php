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
        text-align: center;
    }

    .forgot-pasw-container {
        display: flex;
        height: 97vh;
        align-items: center;
        gap: 2em;
        box-sizing: border-box;
        flex-direction: column;
        justify-content: center;
    }

    .forgot-pasw-form {
        width: 50%;
        line-height: 3em;
    }

    .forgot-pasw-label-input {
        display: grid;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: small;

    }

    .forgot-pasw-input {
        padding: 0.7em;
        border: 1px solid #ccc;
        border-radius: 0.5em;
        width: 100%;
        font-size: small;
    }

    .forgot-text {
        line-height: 2em;
    }

    .forgot-btn {
        padding: 0.5em 2.5em;
        text-transform: uppercase;
        font-size: small;
        letter-spacing: 1px;
        background-color: #F1DCF7;
        border: none;
        border-radius: 0.3em;
        margin-top: 2em;
    }

    .forgot-btn:hover {
        background-color: #ff980091;
        cursor: pointer;
        scale: 1.05;
        transition: ease-in-out 0.1s;
    }
</style>
<div class="forgot-pasw-container">

    <div class="forgot-pasw-form">
        <h1>Forgot your password?</h1>
        <div class="forgot-text">
            {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
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
                <x-primary-button class="forgot-btn">
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
