<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/User.css')}}">
    <title>iFood | Homepage</title>
    <link rel="icon" href="{{ asset('foto/loginlogo.svg') }}" type="image/x-icon">
</head>
<body>
    @if (Route::has('login'))
    @auth
        <p class="mhello">Hello, {{ Auth::user()->name }}!</p>
        <form action="{{route('logout')}}" method="POST">
            @csrf
            <div class="mLR">
                <input type="submit" value="Logout" class="aLogout">
            </div>
        </form>
    @else
    <div class="mhello">
        <p>Hello, welcome!</p>
    </div>
    <div class="mLR">
        <a href="{{route('login')}}" class="aLogin">Login</a>
    </div>
    @endauth
    @endif
    <div class="section">
        <div class="left">
            <div class="left-1">
                <a href="/"><img src="{{ asset('foto/loginlogo.svg') }}" alt="iFood-Logo.svg" width="100"></a>
                <form method="POST" action="{{ url('/search') }}">
                    @csrf
                    <div class="search-bar">
                        <input
                            type="text"
                            name="search"
                            placeholder="Search food name..."
                        />
                        <button class="btnSearch">Search</button>
                    </div>
                </form>
            </div>
            <div class="left-2">
                <div class="location">
                    <div class="navigasi">
                        <img src="{{ asset('foto/nav.svg') }}" alt="">
                        <p>My Location </p>
                    </div>
                    <p> | </p>
                    <p>Salatiga, <a href="https://maps.app.goo.gl/crEip2MwGjDDQYQo6"><span class="cLoc">Perumahan Citra Montana C1</span></p></a>
                </div>
            </div>
            <div class="left-3">
                <img src="{{ asset('foto/banner.svg') }}" alt="Banner.svg" width="825">
            </div>

            <div class="left-3-1">
                <div class="category active">
                    <img src="{{ asset('foto/all.svg') }}" alt="All.svg" width="25">
                    <p>All</p>
                </div>
                <div class="category">
                    <img src="{{ asset('foto/fastfood.svg') }}" alt="All.svg" width="30">
                    <p>Fast Food</p>
                </div>
                <div class="category">
                    <img src="{{ asset('foto/steak.svg') }}" alt="All.svg" width="30">
                    <p>Steak</p>
                </div>
                <div class="category">
                    <img src="{{ asset('foto/chicken.svg') }}" alt="All.svg" width="30">
                    <p>Chicken</p>
                </div>
                <div class="category">
                    <img src="{{ asset('foto/pasta.svg') }}" alt="All.svg" width="35">
                    <p>Pasta</p>
                </div>
                <div class="category">
                    <img src="{{ asset('foto/dessert.svg') }}" alt="All.svg" width="30">
                    <p>Dessert</p>
                </div>
                <div class="category">
                    <img src="{{ asset('foto/drink.svg') }}" alt="All.svg" width="30">
                    <p>Drink</p>
                </div>
            </div>

            <div class="left-3-2">
                <p>Install the app</p>
            </div>

            <div class="left-4">
                <img src="{{ asset('foto/qr.svg') }}" alt="Install.svg" width="395px" class="qr">
                <img src="{{ asset('foto/phone.svg') }}" alt="Phone.svg" width="425px">
            </div>
        </div>
        <div class="right">
            @if ($data->isEmpty())
            <img style="margin-left: 9rem; margin-top: 10rem;" src="{{ asset('foto/errornodata.svg') }}" alt="" width="300">
            @else
                @foreach ($data as $item)
                <div class="box">
                        <img src="{{ asset('images/' . $item->image) }}"/>
                        <div class="harga">
                            <p>${{ $item->harga }}</p>
                        </div>
                        <div class="kategori">
                            <p>{{ $item->kategori }}</p>
                        </div>
                        <div class="isiBox">
                            <p class="nama_product">{{ $item->nama_product }}</p>
                            <br>
                            <p class="description">{{ $item->description }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <script>
        document.querySelectorAll('.category').forEach(category => {
        category.addEventListener('click', function() {
            document.querySelectorAll('.category').forEach(cat => {
                cat.classList.remove('active');
            });
            this.classList.add('active');
            });
        });
        document.querySelectorAll('.description').forEach(desc => {
        const words = desc.innerText.trim().split(" ");
        if (words.length > 121) {
            desc.innerText = words.slice(0, 121).join(" ") + "...";
        }
        });
    </script>
    </script>
</body>
</html>
