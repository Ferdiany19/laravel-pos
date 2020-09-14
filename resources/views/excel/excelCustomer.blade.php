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
            <th>gender</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Date Created</th>
            <th>Date Edit</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($customers as $customer)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->gender }}</td>
            <td>{{ $customer->phone_number }}</td>
            <td>{{ $customer->address }}</td>
            <td>{{ $customer->created_at->format('d-m-Y') }}</td>
            <td>{{ $customer->updated_at->format('d-m-Y') }}</td>
        </tr>
        @empty
            <td colspan="8"><h3 >MAAF DATA SUPPLIER BELUM ADA</h3></td>
        @endforelse
        </tbody>
    </table>
</body>
</html>