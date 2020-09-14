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
            <th>barcode</th>
            <th>Name</th>
            <th>Category</th>
            <th>Unit</th>
            <th>Price</th>
            <th>Method Stock</th>
            <th>Image</th>
            <th>Date Created</th>
            <th>Date Edit</th>
        </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->barcode }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->categorys()->first()->name }}</td>
                <td>{{ $item->units()->first()->name }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->method_stock }}</td>
                <td>{{ $item->image }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="12">Data Masih Kosong</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</body>
</html>