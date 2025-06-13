<?php $nomor = 0; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iFood | Owner Dashboard</title>
    <link rel="icon" href="{{ asset('foto/loginlogo.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/Cashier.css') }}">
</head>

<body>
    <div class="section">
        <div class="sidebar">
            <div class="logo-sidebar">
                <a href="/owner">
                    <img src="{{ asset('foto/logoowneradmin.svg') }}" alt="Logo.svg" width="45">
                </a>
                <img src="{{ asset('foto/aPlus.svg') }}" alt="aPlus.svg" width="35">
                <a href="/history">
                    <img src="{{ asset('foto/history.svg') }}" alt="History.svg" width="35">
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                        <img src="{{ asset('foto/logout.svg') }}" alt="Logout" width="36">
                    </button>
                </form>
            </div>
        </div>
        <div class="content">
            <p class="pOwner">Hello, {{ Auth::user()->name }}!</p>
            @if ($errors->any())
                <script>
                    alert("{{ $errors->first() }}");
                </script>
            @endif
            <div class="mBox">
                @if ($data->isEmpty())
                    <img src="{{ asset('foto/error.svg') }}" class="aturimageerror">
                @else
                    @foreach ($data as $item)
                        <div class="box">
                            <p class="nomor">{{ str_pad(++$nomor, 2, '0', STR_PAD_LEFT) }}</p>
                            <div class="jd">
                                <div class="jh">
                                    <p>{{ $item->nama_product }}</p>
                                    <p>${{ $item->harga }}</p>
                                </div>
                                <p class="description">{{ $item->description }}</p>
                            </div>
                            <p></p>
                            <p></p>
                            <p class="stok">Stock: {{ $item->stok }}</p>
                            <p></p>
                            <p></p>
                            <p class="kategori">{{ $item->kategori }}</p>
                            <p></p>
                            <p></p>
                            <img src="{{ asset('images/' . $item->image) }}" width="150" class="imgg" />
                            <br>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="input-method">
            <div class="link-add-purchase">
                <a href="/owner">Add Product</a>
                <a href="/cashier">Purchase</a>
            </div>
            <div class="form-box">
                <form action="/createPembelian" method="post" class="formd">
                    @csrf
                    <label for="nama_pembeli" class="pemail">Buyer's Name</label>
                    <input name="nama_pembeli" type="text" placeholder="Nama Pembeli" id="nama_pembeli" />
                    <label for="product_id" class="pemail">Product</label>
                    <select name="product_id" id="product_id">
                        @foreach ($data as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_product }}</option>
                        @endforeach
                    </select>
                    <label for="stok_beli" class="pemail">Quantity</label>
                    <input name="stok_beli" type="number" placeholder="Stok Beli" min="0" id="stok_beli" />
                    <label for="harga_beli" class="pemail">Pay</label>
                    <input name="harga_beli" type="number" placeholder="Harga Beli" min="0" id="harga_beli" />
                    <button class="btnAdd">Purchase</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
