@extends('admin.layout.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Transaction</div>
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2">Add Stock</h3>
                    </div>
                    <form action="{{ route('admin.transaction.stockIn.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="name" class="control-label mb-1">Name</label>
                                <select name="name" id="name" class="form-control">
                                    <option value="">-- pilih --</option>
                                    @forelse ($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @empty
                                        
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="supplier" class="control-label mb-1">Supplier</label>
                                <select name="supplier" id="supplier" class="form-control">
                                    <option value="">-- pilih --</option>
                                    @forelse ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @empty
                                        
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="stock" class="control-label mb-1">Stock</label>
                            <input type="text" name="stock" id="stock" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="price" class="control-label mb-1">Price</label>
                            <input type="text" name="price" id="price" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="expire" class="control-label mb-1">Date Expire</label>
                            <input type="date" name="expire" id="expire" class="form-control">
                        </div>
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Submit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#stock').mask('000.000.000.000',{reverse : true});
        $('#price').mask('000.000.000.000',{reverse : true});

        $(document).on('click','#payment-button',function(){
            let stock = $('#stock').val();
            let price = $('#price').val();
            let replace_stock = stock.replace(/\D/g,'');
            let replace_price = price.replace(/\D/g,'');
            $('#stock').val(replace_stock);
            $('#price').val(replace_price);
        });
    </script>
@endsection