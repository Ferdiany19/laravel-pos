<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Name Item</th>
                <th>Stock</th>
                <th>price</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pemasukans as $pemasukan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->find($pemasukan->item_id)->name ?? $pemasukan->item_name }}</td>
                    <td class="format">{{ $pemasukan->stock ?? $pemasukan->qty }}</td>
                    <td>RP. {{ $pemasukan->price < 0 ? '-' : '' }}<div class="format d-inline-block">{{ $pemasukan->price < 0 ? - $pemasukan->price : $pemasukan->price }}</div></td>
                    <td>{{ $pemasukan->created_at }}</td>
                    <td>{{ $pemasukan->updated_at }}</td>
                </tr>
            @empty
            <tr>
                <td colspan="6">Maaf Kosong</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>