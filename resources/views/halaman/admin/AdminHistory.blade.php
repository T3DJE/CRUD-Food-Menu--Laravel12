<?php $nomor = 0; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>iFood | Owner History</title>
    <link rel="icon" href="{{ asset('foto/loginlogo.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/AdminHistory.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
                    <img src="{{ asset('foto/Product.png') }}" alt="Plus.svg" width="35">
                </a>
                <a href="/adminhistory">
                    <img src="{{ asset('foto/aHistory.svg') }}" alt="aHistory.svg" width="35">
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
            <p class="pOwner">Transaction History Table!</p>
            <?php $nomor = 0; ?>
            <table class="table-css">
                <tr class="tabletr">
                    <th style="text-align: center">ID</th>
                    <th style="text-align: center">Buyer's Name</th>
                    <th style="text-align: center">Product Name</th>
                    <th style="text-align: center">Quantity</th>
                    <th style="text-align: center">Total Purchase</th>
                    <th style="text-align: center">Payment</th>
                    <th style="text-align: center">Status</th>
                </tr>
                @foreach ($data as $index => $item)
                    <tr class="tabletr2">
                        <td style="text-align: center">
                            <p class="nomor">{{ str_pad(($data->currentPage() - 1) * $data->perPage() + $index + 1, 2, '0', STR_PAD_LEFT) }}</p>
                        </td>
                        <td>{{ $item->nama_pembeli }}</td>
                        <td style="text-align: center">{{ $item->product->nama_product }}</td>
                        <td style="text-align: center">{{ $item->stok_beli }}</td>
                        <td style="text-align: center">${{ $item->total_bayar }}</td>
                        <td style="text-align: center">${{ $item->harga_beli }}</td>
                        <td style="text-align: center">
                            <img src="{{ asset('foto/success.svg') }}" alt="Success.svg" width="100">
                        </td>
                    </tr>
                @endforeach
            </table>
            <div class="pageberubah">
                {{ $data->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</body>

</html>
