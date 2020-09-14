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
		<h5>Stock Retur</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
                <th>No</th>
                <th>Barang Dari</th>
                <th>Invoice</th>
                <th>User</th>
                <th>Customer</th>
                <th>Name Item</th>
                <th>Supplier</th>
                <th>Stock</th>
                <th>Expire</th>
                <th>Price</th>
                <th>Description</th>
                <th>Pengecekan</th>
                <th>Item Create</th>
                <th>Item Edit</th>
			</tr>
		</thead>
		<tbody>
			@forelse ($stock_returs as $stock_retur)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $stock_retur->retur_dari === 'c' ? 'customer' : 'gudang' }}</td>
                        <td>{{ $stock_retur->invoice ?? 'kosong' }}</td>
                        <td>{{ $stock_retur->user_name ?? 'kosong'  }}</td>
                        <td>{{ $stock_retur->customers_name ?? 'kosong' }}</td>
                        <td>{{ $stock_retur->item_name }}</td>
                        <td>{{ $stock_retur->supplier_name ?? 'kosong' }}</td>
                        <td class="stock">{{ $stock_retur->stock }}</td>
                        <td>{{ $stock_retur->expire ? $stock_retur->expire->format('d-m-Y') : 'kosong' }}</td>
                        <td>{{ $stock_retur->price ? 'RP. ' : '' }}
                            <div class="d-inline-block price">{{ $stock_retur->price ?? 'kosong'}}</div>
                        </td>
                        <td>{{ $stock_retur->description }}</td>
                        <td>
                            {!! $stock_retur->pengecekan === 'p' ? 'DiProses' : '' !!}
                            {!! $stock_retur->pengecekan === 'ta' ? 'DiTerima' : '' !!}
                            {!! $stock_retur->pengecekan === 'tk' ? 'DiTolak' : '' !!}
                        </td>
                        <td>{{ $stock_retur->created_at->format('d-m-Y') }}</td>
                        <td>{{ $stock_retur->updated_at ? $stock_retur->updated_at->format('d-m-Y') : 'kosong'  }}</td>
                    </tr>
                @empty
                    
                @endforelse
		</tbody>
	</table>
 
</body>
</html>