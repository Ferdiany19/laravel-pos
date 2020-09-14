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
            @forelse ($pengeluarans as $pengeluaran)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->find($pengeluaran->item_id)->name ?? $pengeluaran->item_name }}</td>
                    <td class="format">{{ $pengeluaran->stock ?? $pengeluaran->qty }}</td>
                    <td>RP. {{ $pengeluaran->price < 0 ? '-' : '' }}<div class="format d-inline-block">{{ $pengeluaran->price < 0 ? - $pengeluaran->price : $pengeluaran->price }}</div></td>
                    <td>{{ $pengeluaran->created_at }}</td>
                    <td>{{ $pengeluaran->updated_at }}</td>
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