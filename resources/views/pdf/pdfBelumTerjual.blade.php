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
		<h5>Belum Terjual</h4>
	</center>
 
	<table class='table table-bordered'>
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