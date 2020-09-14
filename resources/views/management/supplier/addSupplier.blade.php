@extends('management.layout.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">SUPPLIER</div>
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2">Add Supplier</h3>
                    </div>
                    <form action="{{ route('management.supplier.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="control-label mb-1">Name</label>
                            <input id="name" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="">
                        </div>
                        <div class="form-group">
                            <label for="phone" class="control-label mb-1">Phone Number</label>
                            <input id="phone" name="phone" type="tel" class="form-control" aria-required="true" aria-invalid="false" value="">
                        </div>
                        <div class="form-group">
                            <label for="address" class="control-label mb-1">Address</label>
                            <textarea name="address" id="address" cols="30" rows="5" class="form-control" aria-required="true" aria-invalid="false"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="description" class="control-label mb-1">Description</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control" aria-required="true" aria-invalid="false"></textarea>
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
        $('#phone').mask('0000-0000-0000-0000',{reverse : true});
        $(document).on('click','#payment-button',function(){
            let phone = $('#phone').val();
            let replace = phone.replace(/\D/g,'');
            $('#phone').val(replace);
        });
    </script>
@endsection