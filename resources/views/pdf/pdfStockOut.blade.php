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
		<h5>Stock Out</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
                <th>No</th>
                <th>Invoice</th>
                <th>Customer</th>
                <th>User</th>
                <th>Name Item</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Item Create</th>
                <th>Item Edit</th>
			</tr>
		</thead>
		<tbody>
			@forelse ($orders as $order)
                    <tr>
                        <td rowspan="{{ count($order->order_details()->get()) }}">{{ $loop->iteration }}</td>
                        <td rowspan="{{ count($order->order_details()->get()) }}">#{{ $order->invoice }}</td>
                        <td rowspan="{{ count($order->order_details()->get()) }}">{{ $order->customers()->first()->name }}</td>
                        <td rowspan="{{ count($order->order_details()->get()) }}">{{ $order->users()->first()->user_profiles()->first()->fullname }}</td>
                        @forelse ($order->order_details()->get() as $order_detail)
                        {!! $loop->iteration > 1 ? '<tr>' : '' !!}
                            <td>{{ $order_detail->items()->first()->name }}</td>
                            <td>{{ $order_detail->qty }}</td>
                            <td>RP. <div class="price d-inline-block">{{ $order_detail->price ?? '0' }}</div></td>
                            <td>{{ $order_detail->created_at }}</td>
                            <td>{{ $order_detail->updated_at }}</td>
                        </tr>
                        @empty
                            
                        @endforelse
                @empty
                    
                @endforelse
		</tbody>
	</table>
 
</body>
</html>