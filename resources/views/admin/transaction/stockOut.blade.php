@extends('admin.layout.layout')
@section('judul')
    Stock Out Item
@endsection
@section('content')
<div class="mt-3 row">
    <div class="col-md-6 mb-1">
        <a class="btn btn-danger form-control" href="{{ route('admin.transaction.stockOut.pdf') }}" target="_blank">Export Stock Out PDF <i class="fas fa-file-pdf"></i></a>
    </div>
    <div class="col-md-6 mb-1">
        <a class="btn btn-success form-control"  href="{{ route('admin.transaction.stockOut.excel') }}" target="_blank">Export Stock Out Excel <i class="fas fa-file-excel"></i></a>
    </div>
</div>
<div class="mt-2">
    <div class="table-responsive table--no-card m-b-30">
        <table class="table table-borderless table-striped table-earning">
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td rowspan="{{ count($order->order_details()->get()) + 1 }}">{{ $loop->iteration }}</td>
                        <td rowspan="{{ count($order->order_details()->get()) + 1 }}">#{{ $order->invoice }}</td>
                        <td rowspan="{{ count($order->order_details()->get()) + 1 }}">{{ $order->customers()->first()->name }}</td>
                        <td rowspan="{{ count($order->order_details()->get()) + 1 }}">{{ $order->users()->first()->user_profiles()->first()->fullname }}</td>
                    </tr>
                        @forelse ($order->order_details()->get() as $order_detail)
                        <tr>
                            <td>{{ $order_detail->items()->first()->name }}</td>
                            <td>{{ $order_detail->qty }}</td>
                            <td>RP. <div class="price d-inline-block">{{ $order_detail->price ?? '0' }}</div></td>
                            <td>{{ $order_detail->created_at }}</td>
                            <td>{{ $order_detail->updated_at }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#retur{{ $order_detail->id }}">Retur</button>
                                <form action="{{ route('admin.transaction.stockOut.destroy',$order_detail->id) }}" method="POST" enctype="multipart/form-data" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            
                        @endforelse
                @empty
                    
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('modals')
@forelse ($orders as $order)
    @forelse ($order->order_details()->get() as $order_detail)
    <div class="modal fade" id="retur{{ $order_detail->id }}" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollmodalLabel">Retur Barang #{{ $order->invoice }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.transaction.stockRetur.store.stock.out',$order_detail->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="control-label mb-1">Name</label>
                            <input type="text" class="form-control" disabled value="{{ $order_detail->items()->first()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label mb-1">Supplier</label>
                            <input type="text" name="supplier" id="" class="form-control" placeholder="Kalau tidak Tahu kosongkan saja">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label mb-1">Stock Retur</label>
                            <input type="text" name="retur" id="" class="form-control stock" value="{{ $order_detail->qty }}">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label mb-1">Description</label>
                            <textarea name="description" id="" cols="30" rows="6" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @empty
        
    @endforelse
@empty
    
@endforelse
@endsection
@section('script')
    <script>
        $('.price').mask('000.000.000.000',{reverse : true});
        $('.stock').mask('000.000.000.000',{reverse : true});
        $(document).on('click','button[type="submit"]',function(){
            let input_stock = $(this).closest('form').find('[name="retur"]');
            let stock = input_stock.val();
            let replace_stock = stock.replace(/\D/g,'');
            input_stock.val(replace_stock);
        });
        $(document).on('click','.btn-warning',function(){
            $('.stock').unmask();
            $('.stock').mask('000.000.000.000',{reverse : true});
        });
    </script>
@endsection