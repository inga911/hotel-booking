{{-- <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500&display=swap');

    /* * {
        font-family: 'Raleway', sans-serif;
    }

    body {
        background: #8288cf1c;
        height: 100vh;
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    } */
    *,
    *::after,
    *::before {
        margin: 0;
        padding: 0;
        box-sizing: inherit;
    }

    body {
        background: #8288cf1c;
        box-sizing: border-box;
        font-family: 'Raleway', sans-serif;
    }

    html {
        font-size: 62.5%;

    }

    h1 {
        text-transform: uppercase;
        letter-spacing: 3px;
        color: #5b6096;
        font-size: 5rem;
        margin: 0;
    }

    .password-input-container {
        display: flex;
        align-items: center;
        font-size: 3rem
    }

    .password-visibility {
        cursor: pointer;
        margin-left: -3rem;
        width: 1.5rem;
    }

    .login-container {
        /* display: grid; */
        align-items: center;
        gap: 2em;
        /* box-sizing: border-box; */
        flex-direction: column;
        justify-content: center;
        width: 100vw;
    }


    .login-form {
        width: 100%;
        line-height: 3em;
    }

    .login-label-input {
        display: grid;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 1.5rem;

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
</style> --}}
<style>
    *,
    *::after,
    *::before {
        margin: 0;
        padding: 0;
        box-sizing: inherit;
    }

    body {
        background: rgba(205, 202, 202, 0.448);
        box-sizing: border-box;
        font-family: 'Raleway', sans-serif;
        color: rgb(7, 5, 87);
    }

    html {
        font-size: 62.5%;
    }

    @media only screen and (max-width: 1000px) {
        html {
            font-size: 50%;
        }
    }



    h1 {
        font-size: 8rem;
        text-transform: uppercase;
        text-align: center;
        margin-top: 5%;
        margin-bottom: 5%;
        letter-spacing: 5px;
    }

    @media only screen and (max-width: 800px) {
        h1 {
            font-size: 6rem;
        }
    }

    /* .login-container {
        margin-top: 30%;
    } */

    /* @media only screen and (max-width: 1000px) {
        h1 {
            font-size: 3rem;
        }
    }

    @media only screen and (max-width: 400px) {
        .login-container {
            margin-top: 45%;
        }
    } */

    .form {
        text-align: center;
        width: 40%;
        margin-left: 50%;
        transform: translateX(-50%);
    }

    @media only screen and (max-width: 800px) {
        .form {
            width: 60%;
        }
    }

    .input-label {
        display: grid;
        margin: 5% 0;
    }

    .login-label {
        font-size: 1.5rem;
        text-transform: uppercase;
        padding: 1rem 0;
        word-spacing: 3px;
        letter-spacing: 1px;
    }

    .login-input {
        line-height: 2.5;
        font-size: 2rem;
        text-align: center;
        border: none;
        border-bottom: .5px solid rgb(7, 5, 87);
    }

    .form__password {
        position: relative;
    }

    .password-visibility {
        position: absolute;
        bottom: .5rem;
        right: 1rem;
        width: 3rem;
        cursor: pointer;
    }

    .form-buttons {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-between;
        font-size: 1.2rem;
    }

    .form-buttons {
        margin-top: 2rem;
        font-size: 1.5rem
    }

    .login-btn {
        font-size: 1.5rem;
        text-align: center;
        width: 100%;
        line-height: 2;
        border: none;
        background: rgb(7, 5, 87);
        color: rgb(243, 176, 5);
        padding: .8rem 0;
        text-transform: uppercase;
        border-radius: 5px;
        cursor: pointer;
        transition: all .2s;
    }


    .login-btn:hover {
        text-align: center;
        width: 100%;
        line-height: 2;
        border: none;
        background: rgb(243, 176, 5);
        color: rgb(7, 5, 87);
        padding: .8rem 0;
        text-transform: uppercase;
        border-radius: 5px;
        box-shadow: 0 1rem 1rem rgb(186, 186, 186);
    }


    .login-btn:active {
        transform: translateY(2px);
        box-shadow: 0 .6rem .6rem rgb(186, 186, 186);
    }

    .login-link {
        font-size: 1.5rem;
        text-decoration: none;
        color: rgb(7, 5, 87);
        letter-spacing: 1px;
        position: relative;
        overflow: hidden;
        padding: 1rem 0;
        line-height: 1.5;
    }

    .login-link::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 1px;
        background-color: rgb(243, 176, 5);
        left: 0;
        bottom: 0;
        transform-origin: right;
        transform: scaleX(0);
        transition: transform .3s ease-in-out;
    }

    .login-link:hover::before {
        transform-origin: left;
        transform: scaleX(1);
    }

    .login-link:hover {
        color: rgb(243, 176, 5);
    }
</style>
<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />
<div class="login-container">
    <h1>Welcome!</h1>

    <form method="POST" action="{{ route('login') }}" class="form">
        @csrf
        <!-- Login -->
        <div class="input-label">
            <x-input-label for="login" :value="__('Email / Name / Phone')" class="login-label" />
            <x-text-input id="login" class="login-input  @error('login') is-invalid @enderror" type="text"
                name="login" :value="old('login')" required autofocus autocomplete="username" />
            @error('login')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <!-- Password -->
        <div class="form__password input-label">
            <x-input-label for="password" :value="__('Password')" class="login-label" />
            {{-- <div class="form__password--input"> --}}
            <x-text-input id="password" class="login-input password-input " type="password" name="password" required
                autocomplete="new-password" />

            <img width="" height="" class="toggle-password-icon password-visibility"
                onclick="togglePasswordVisibility('password')" src="https://img.icons8.com/ios/50/hide.png"
                alt="visible--v1" />
            {{-- </div> --}}
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="form-buttons">

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="login-link" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            <div>
                Not a Member?
                <a class="login-link" href="{{ route('register') }}">
                    {{ __('Sign Up') }}
                </a>
            </div>
        </div>
        <div class="form-buttons">
            <x-primary-button class="login-btn">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
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
