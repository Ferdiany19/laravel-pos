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