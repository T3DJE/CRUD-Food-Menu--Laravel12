<?php $nomor = 0; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iFood | Admin Product</title>
    <link rel="icon" href="{{ asset('foto/loginlogo.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/AdminCreate.css') }}">
</head>

<body>
    <div class="section">
        <div class="sidebar">
            <div class="logo-sidebar">
                <a href="/admin">
                    <img src="{{ asset('foto/logoowneradmin.svg') }}" alt="Logo.svg" width="45">
                </a>
                <a href="/admin">
                    <img src="{{ asset('foto/Dashboard.svg') }}" alt="Plus.svg" width="35">
                </a>
                <a href="/create">
                    <img src="{{ asset('foto/aProduct.svg') }}" alt="Plus.svg" width="35">
                </a>
                <a href="/adminhistory">
                    <img src="{{ asset('foto/History.svg') }}" alt="aHistory.svg" width="35">
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
            <p class="pOwner">Hello, Admin!</p>
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
                    @if ($item->stok > 0)
                        <p class="stok">{{ $item->stok }}</p>
                    @else
                        <p class="null-stok">Stok Kosong!</p>
                    @endif
                    <p></p>
                    <p></p>
                    <p class="kategori">{{ $item->kategori }}</p>
                    <p></p>
                    <p></p>
                    <img src="{{ asset('images/' . $item->image) }}" width="150" class="imgg"/>
                    <br>
                    <div class="btnAction">
                        <a href="/edit/{{ $item->id }}">Update</a>
                        <a href="/delete/{{ $item->id }}">Delete</a>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
        <div class="input-method">
            <div class="link-add-purchase">
                <a href="/create">Add Product</a>
            </div>
            <div class="form-box">
                <form action="/process-create" method="post" enctype="multipart/form-data" class="formd">
                    @csrf
                    <label for="nama_product" class="pemail">Product Name</label>
                    <input name="nama_product" type="text" placeholder="Product Name" id="nama_product"/>
                    <label for="harga" class="pemail">Price</label>
                    <input name="harga" type="number" placeholder="Price" min="0" id="harga"/>
                    <label for="stok" class="pemail">Stock</label>
                    <input name="stok" type="number" placeholder="Stock" min="0" id="stok"/>
                    <label for="kategori" class="pemail">Category</label>
                    <select name="kategori" id="kategori">
                        <option value="Fast Food">Fast Food</option>
                        <option value="Steak">Steak</option>
                        <option value="Chicken">Chicken</option>
                        <option value="Pasta">Pasta</option>
                        <option value="Dessert">Dessert</option>
                        <option value="Drink">Drink</option>
                    </select>
                    <label for="description" class="pemail">Description</label>
                    <input name="description" type="text" placeholder="Description" id="description" max="121"/>
                    <div class="btnImage">
                        <label for="image" class="bi">Image</label>
                        <label for="image" class="edit-file-button">Choose File</label>
                        <input type="file" name="image" id="image"/>
                    </div>
                    <button class="btnAdd">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
