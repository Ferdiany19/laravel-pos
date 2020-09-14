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
		<h5>Supplier</h4>
	</center>
 
	<table class='table table-bordered'>
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
			@forelse ($suppliers as $supplier)
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