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
        table{
            border-collapse: collapse;
        }
	</style>
	<center>
		<h5>Stock In</h4>
	</center>
 
	<table class='table table-bordered' border="1">
		<thead>
			<tr>
                <th>No</th>
                <th>Name Item</th>
                <th>Supplier</th>
                <th>User</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Expire</th>
                <th>Item Create</th>
                <th>Item Edit</th>
			</tr>
		</thead>
		<tbody>
			@forelse ($items as $item)
                    <tr>
                        <td rowspan="{{ count($item->stock_items()->get()) }}">{{ $loop->iteration }}</td>
                        <td rowspan="{{ count($item->stock_items()->get()) }}">{{ $item->name }}</td>
                    @forelse ($item->stock_items()->get() as $stock)
                    {!! $loop->iteration > 1 ? '<tr>' : '' !!}
                        <td>{{ $stock->suppliers()->first()->name }} {{ $loop->iteration }}</td>
                        <td>{{ $stock->users()->first()->name }}</td>
                        <td>{{ $stock->stock }}</td>
                        <td>RP. <div class="price d-inline-block">{{ $stock->price ?? '0'}}</div></td>
                        <td>{{ $stock->expire->format('d-m-Y') }}</td>
                        <td>{{ $stock->created_at->setTimezone('Asia/Jakarta')->format('d-m-Y H:i') }}</td>
                        <td>{{ $stock->updated_at->setTimezone('Asia/Jakarta')->format('d-m-Y H:i') }}</td>
                    </tr>
                    @empty
                            <td colspan="7"><h3>Data Belum ada</h3></td>
                        </tr>
                    @endforelse
                @empty
                    <tr>
                        <td colspan="8"><h3>Item Belum ada</h3></td>
                    </tr>
                @endforelse
		</tbody>
	</table>
</body>
</html>