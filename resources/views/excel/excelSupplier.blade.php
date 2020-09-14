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
            <th>Name</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Description</th>
            <th>Date Created</th>
            <th>Date Edit</th>
        </tr>
        </thead>
        <tbody>
        @forelse($suppliers as $supplier)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $supplier->name }}</td>
            <td>{{ $supplier->phone_number }}</td>
            <td>{{ $supplier->address }}</td>
            <td>{{ $supplier->description }}</td>
            <td>{{ $supplier->created_at->format('d-m-Y') }}</td>
            <td>{{ $supplier->updated_at->format('d-m-Y') }}</td>
        </tr>
        @empty
            <td colspan="8"><h3 >MAAF DATA SUPPLIER BELUM ADA</h3></td>
        @endforelse
        </tbody>
    </table>
</body>
</html>