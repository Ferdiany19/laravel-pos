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
		<h5>Product</h4>
	</center>
 
	<table class='table table-bordered'>
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
                    <td><center>{!! $d->getBarcodeHTML(strval($item->barcode), 'EAN13') !!} {{ $item->barcode }}</center></td>
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