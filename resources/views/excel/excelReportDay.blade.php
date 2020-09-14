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
            <td colspan="8" style="text-align: center">Report Hari {{ $date }}</td>
        </tr>
        <tr>
            <th>No</th>
            <th>Invoice</th>
            <th>Nama Item</th>
            <th>Stock</th>
            <th>Price</th>
            <th>Laba</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        </thead>
        <tbody>
			@forelse ($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->invoice }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->laba }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Maaf Belum Ada Data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>