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
            @forelse ($retur_pengeluarans as $retur_pengeluaran)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->find($retur_pengeluaran->item_id)->name ?? $retur_pengeluaran->item_name }}</td>
                    <td class="format">{{ $retur_pengeluaran->stock ?? $retur_pengeluaran->qty }}</td>
                    <td>RP. {{ $retur_pengeluaran->price }}</td>
                    <td>{{ $retur_pengeluaran->created_at }}</td>
                    <td>{{ $retur_pengeluaran->updated_at }}</td>
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