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
            @forelse ($belum_terjuals as $belum_terjual)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->find($belum_terjual->item_id)->name ?? $belum_terjual->item_name }}</td>
                <td class="format">{{ $belum_terjual->stock ?? $belum_terjual->qty }}</td>
                <td>RP. {{ $belum_terjual->price }}</td>
                <td>{{ $belum_terjual->created_at }}</td>
                <td>{{ $belum_terjual->updated_at }}</td>
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