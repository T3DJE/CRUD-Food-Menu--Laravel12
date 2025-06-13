<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/Register.css') }}">
    <title>iFood | Register</title>
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
            <p class="p1">Create your Account</p>
            <p class="p2">Start managing your business today</p>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <label for="name" class="pemail">Name</label>
                    <br>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="email" placeholder="Your name">
                    @error('name')
                        <div>{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="email" class="pemail">Email</label>
                    <br>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required class="email" placeholder="Email">
                    @error('email')
                        <div>{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="password" class="ppassword">Password</label>
                    <br>
                    <input id="password" type="password" name="password" required class="password" placeholder="Password">
                    @error('password')
                        <div>{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="ppassword">Confirm Password</label>
                    <br>
                    <input id="password_confirmation" type="password" name="password_confirmation" required class="password" placeholder="Confirm Password">
                    @error('password_confirmation')
                        <div>{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="loginbtn">Register</button>
                </div>

                <div class="bottom">
                    <p>Already have an account?</p>
                    <a href='{{ route('login') }}' class="fyp">Log in now</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
