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
            <?php
            $i = 1;
            ?>
            @forelse ($items as $item)
                    <tr>
                        <td>{{  $i++ }}</td>
                        <td>{{ $item->name }}</td>
                    @forelse ($item->stock_items()->get() as $stock)
                    {!! $loop->iteration > 1 ? '<tr>' : '' !!}
                        {!! $loop->iteration > 1 ? '<td>'. $i++ .'</td>' : '' !!}
                        {!! $loop->iteration > 1 ? '<td>'. $item->name .'</td>' : '' !!}
                        <td>{{ $stock->suppliers()->first()->name }}</td>
                        <td>{{ $stock->users()->first()->name }}</td>
                        <td>{{ $stock->stock }}</td>
                        <td>RP. <div class="price d-inline-block">{{ $stock->price ?? '0'}}</div></td>
                        <td class="{{ $stock->bg_alert ? $stock->bg_alert . ' text-white' : '' }}" {!! $stock->bg_alert ? 'data-toggle="tooltip" data-placement="right" title=' . $stock->expire->format('d-m-Y') : '' !!}>{{ $stock->message ?? $stock->expire->format('d-m-Y') }}</td>
                        <td>{{ $stock->created_at->setTimezone('Asia/Jakarta')->format('d-m-Y H:i') }}</td>
                        <td>{{ $stock->updated_at->setTimezone('Asia/Jakarta')->format('d-m-Y H:i') }}</td>
                    </tr>
                    @empty
                            <td colspan="7"><h3>Data Belum ada</h3></td>
                        </td>
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