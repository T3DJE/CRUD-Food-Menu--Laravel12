<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/Login.css') }}">
    <title>iFood | Login</title>
    <link rel="icon" href="{{ asset('foto/loginlogo.svg') }}" type="image/x-icon">
</head>
<body>
    @if (session('status'))
        <div>
            {{ session('status') }}
        </div>
    @endif

    <div class="section">
        <div class="left">
            <video width="860" height="900" loop muted autoplay class="videoLogin">
                <source src="{{ asset('videos/ssstik.io_1748403292065.mp4') }}" type="video/mp4">
            </video>
        </div>
        <div class="right">
            <a href="/"><img src="{{ asset('foto/loginlogo.svg') }}" width="100" class="logo"></a>
            <p class="p1">Login to your Account</p>
            <p class="p2">See what is going on with your business</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <label for="email" class="pemail">Email</label>
                    <br>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="email" placeholder="Email">
                    @error('email')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="password" class="ppassword">Password</label>
                    <br>
                    <input id="password" type="password" name="password" required autocomplete="current-password" class="password" placeholder="Password">
                    @error('password')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
                <div class="section4">
                    <label for="remember_me">
                        <input id="remember_me" type="checkbox" name="remember" class="checkedrm">
                        <span class="rememberme">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="fyp">Forgot your password?</a>
                    @endif
                </div>
                <div>
                    <button type="submit" class="loginbtn">Log in</button>
                </div>
                <div class="bottom">
                    <p> Not Registered Yet?</p>
                    <a href='/register' class="fyp">Create an account</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
