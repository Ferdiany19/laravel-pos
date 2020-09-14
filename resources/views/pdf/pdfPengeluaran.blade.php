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
		<h5>Pengeluaran</h4>
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
			@forelse ($pengeluarans as $pengeluaran)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->find($pengeluaran->item_id)->name ?? $pengeluaran->item_name }}</td>
                    <td class="format">{{ $pengeluaran->stock ?? $pengeluaran->qty }}</td>
                    <td>RP. {{ $pengeluaran->price < 0 ? '-' : '' }}<div class="format d-inline-block">{{ $pengeluaran->price < 0 ? - $pengeluaran->price : $pengeluaran->price }}</div></td>
                    <td>{{ $pengeluaran->created_at }}</td>
                    <td>{{ $pengeluaran->updated_at }}</td>
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