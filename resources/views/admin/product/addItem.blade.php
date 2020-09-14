@extends('admin.layout.layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">ITEM</div>
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Add Item</h3>
                </div>
                <form action="{{ route('admin.item.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label mb-1">Name</label>
                        <input id="name" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
                    </div>
                    <div class="form-group">
                        <label for="category" class="control-label mb-1">Category</label>
                        <select name="category" id="category" class="form-control" aria-required="true" aria-invalid="false">
                            <option value="">-- Select --</option>
                            @forelse ($categorys as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="unit" class="control-label mb-1">Unit</label>
                        <select name="unit" id="unit" class="form-control" aria-required="true" aria-invalid="false">
                            <option value="">-- Select --</option>
                            @forelse ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="warning_expire">Warning Expire</label>
                        <input type="text" name="warning_expire" id="warning_expire" class="form-control" placeholder="misal nya 7, maksudnya 7 hari lagi akan kadaluarsa">
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-lg-4">
                            <label for="price" class="control-label mb-1">Price</label>
                            <input id="price" name="price" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="methodStock" class="control-label mb-1">method stock</label>
                            <select name="methodStock" id="methodStock" class="form-control">
                                <option value="">-- pilih --</option>
                                <option value="fifo">fifo</option>
                                <option value="lifo">lifo</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <div class=" col-12">
                                <label for="imageItem" class=" form-control-label">Image Item</label>
                            </div>
                            <div class="col-12">
                                <input type="file" id="imageItem" name="imageItem" class="form-control-file">
                            </div>
                        </div>
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
        $('#warning_expire').mask('000.000.000.000',{reverse : true});
        $('#price').mask('000.000.000.000',{reverse : true});

        $(document).on('click','#payment-button',function(){
            let warning_expire = $('#warning_expire').val();
            let price = $('#price').val();
            let replace_warning_expire = warning_expire.replace(/\D/g,'');
            let replace_price = price.replace(/\D/g,'');
            $('#warning_expire').val(replace_warning_expire);
            $('#price').val(replace_price);
        });
    </script>
@endsection