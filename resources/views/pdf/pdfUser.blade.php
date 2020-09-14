<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>User Terdaftar</h4>
	</center>
 
	<table class='table table-bordered'>
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