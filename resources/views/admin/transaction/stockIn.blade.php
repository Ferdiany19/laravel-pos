@extends('admin.layout.layout')
@section('judul')
    Stock In Item
@endsection
@section('btn_add')
<a href="{{ route('admin.transaction.stockIn.create') }}" class="au-btn au-btn-icon au-btn--blue">
    <i class="zmdi zmdi-plus"></i>add Stock
</a>
@endsection
@section('content')
<div class="mt-3 row">
    <div class="col-md-6 mb-1">
        <a class="btn btn-danger form-control" href="{{ route('admin.transaction.stockIn.pdf') }}" target="_blank">Export Stock In PDF <i class="fas fa-file-pdf"></i></a>
    </div>
    <div class="col-md-6">
        <a class="btn btn-success form-control" href="{{ route('admin.transaction.stockIn.excel') }}" target="_blank">Export Stock In Excel <i class="fas fa-file-excel"></i></a>
    </div>
</div>
<div class="mt-2">
    <div class="table-responsive table--no-card m-b-30">
        <table class="table table-borderless table-striped table-earning">
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td rowspan="{{ count($item->stock_items()->get()) + 1 }}">{{ $loop->iteration }}</td>
                        <td rowspan="{{ count($item->stock_items()->get()) + 1 }}">{{ $item->name }}</td>
                    @forelse ($item->stock_items()->get() as $stock)
                    <?php
                        $hari_ini = Carbon\Carbon::now()->setTime(0,0,0);
                        $exp = Carbon\Carbon::parse($stock->expire);
                        $diff_in_days = $hari_ini->diffInDays($exp);
                        if( $diff_in_days <= $stock->items()->first()->warning_expire){
                            if($hari_ini == $exp){
                                $stock['message'] = "hari ini kadaluarsa";
                                $stock['bg_alert'] = "btn-danger";
                            }
                            else if($hari_ini > $exp){
                                $stock['message'] = "sudah kadaluarsa";
                                $stock['bg_alert'] = "btn-dark";
                            }
                            else{
                                $stock['message'] = "akan kadaluarsa $diff_in_days hari lagi";
                                $stock['bg_alert'] = "btn-danger";
                            }
                        }
                    ?>
                    <tr id="item{{ $stock->id }}">
                        <td>{{ $stock->suppliers()->first()->name }}</td>
                        <td>{{ $stock->users()->first()->name }}</td>
                        <td>{{ $stock->stock }}</td>
                        <td>RP. <div class="price d-inline-block">{{ $stock->price ?? '0'}}</div></td>
                        <td class="{{ $stock->bg_alert ? $stock->bg_alert . ' text-white' : '' }}" {!! $stock->bg_alert ? 'data-toggle="tooltip" data-placement="right" title=' . $stock->expire->format('d-m-Y') : '' !!}>{{ $stock->message ?? $stock->expire->format('d-m-Y') }}</td>
                        <td>{{ $stock->created_at->setTimezone('Asia/Jakarta')->format('d-m-Y H:i') }}</td>
                        <td>{{ $stock->updated_at->setTimezone('Asia/Jakarta')->format('d-m-Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.transaction.stockIn.show',$stock->id) }}" class="btn btn-info">Edit</a>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#retur{{ $stock->id }}">Retur</button>
                            <form action="{{ route('admin.transaction.stockIn.destory',$stock->id) }}" method="POST" enctype="multipart/form-data" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                            <td colspan="8"><h3>Data Belum ada</h3></td>
                        </tr>
                    @endforelse
                @empty
                    <tr>
                        <td colspan="9"><h3>Item Belum ada</h3></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('modals')
    @forelse ($items as $item)
        @forelse ($item->stock_items()->get() as $stock)
            <div class="modal fade" id="retur{{ $stock->id }}" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="scrollmodalLabel">Retur Barang {{ $item->name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.transaction.stockRetur.store.stock.in',$stock->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Item</label>
                                    <input type="text" disabled class="form-control" value="{{ $item->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Supplier</label>
                                    <input type="text" disabled class="form-control" value="{{ $stock->suppliers()->first()->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="stock" class="control-label mb-1">Stock</label>
                                    <input type="text" name="stock" class="form-control stock" value="{{ $stock->stock }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="control-label mb-1">Description</label>
                                    <textarea name="description" class="form-control" id="description" cols="30" rows="6" required></textarea>
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
        $('.stock').mask('000.000.000.000',{reverse : true});
        $('.price').mask('000.000.000.000',{reverse : true});
        $(document).on('click','button[type="submit"]',function(){
            let input_stock = $(this).closest('form').find('[name="stock"]');
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