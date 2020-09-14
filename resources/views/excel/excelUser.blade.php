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
            <th>Gender</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Role User</th>
            <th>Image</th>
            <th>Address</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->user_profiles()->first()->fullname }}</td>
                <td>{{ $user->user_profiles()->first()->gender === 'm' ? 'male' : 'female'}}</td>
                <td>{{ $user->user_profiles()->first()->phone_number }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role_users()->first()->name }}</td>
                <td>{{ $user->user_profiles()->first()->image }}</td>
                <td>{{ $user->user_profiles()->first()->address }}</td>
                <td>{{ $user->user_profiles()->first()->created_at }}</td>
                <td>{{ $user->user_profiles()->first()->updated_at }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="10">Maaf Data Belum Ada</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</body>
</html>