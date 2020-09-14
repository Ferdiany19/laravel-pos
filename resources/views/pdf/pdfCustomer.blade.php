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
		<h5>Customer</h4>
	</center>
 
	<table class='table table-bordered'>
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