@extends('kasir.layout.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Transaction</div>
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2">Add Order</h3>
                    </div>
                    <form action="{{ route('kasir.transaction.order.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="customer" class="control-label mb-1">Customer</label>
                            <select name="customer" id="customer" class="form-control">
                                <option value="">-- pilih --</option>
                                @forelse ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label mb-1">jumlah yang harus di bayar</label>
                            <div class="form-control">RP. <div class="d-inline-block jumlah-bayar" name="jumlah_dibayar" id="jumlah_dibayar">0</div></div>
                        </div>
                        <div class="form-group">
                            <label for="uang_customer" class="control-label mb-1">Uang Customer</label>
                            <input type="text" name="uang_customer" id="uang_customer" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label mb-1">jumlah kembalian</label>
                            <div class="form-control">RP. <div class="d-inline-block" id="mines"></div><div class="d-inline-block" id="jumlah-kembalian">0</div></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-1">Item</label>
                            <div class="row">
                                <div class="form-group col-11 pr-0">
                                    <input type="text"class="form-control" id="item" placeholder="barcode">
                                </div>
                                <div class="form-group col-1 pl-0">
                                    <button type="button" class="btn btn-primary" id="search-item"><i class="zmdi zmdi-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="" class="control-label mb-1">Nama Item</label>
                                <input type="text" class="form-control" disabled id="nama-item">
                            </div>
                            <div class="form-group col-4">
                                <label for="" class="control-label mb-1">Stock Pertama</label>
                                <input type="text" class="form-control" disabled id="stock-pertama">
                            </div>
                            <div class="form-group col-4">
                                <label for="" class="control-label mb-1">Price</label>
                                <input type="text" class="form-control" disabled id="price-item">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-10">
                                <label class="control-label mb-1">Stock</label>
                                <input type="number"class="form-control" id="stock">
                            </div>
                            <div class="col-2 d-flex">
                                <div class="mt-auto mb-auto">
                                    <button type="button" class="btn btn-warning" id="add-new-order">Add</button>
                                </div>
                            </div>
                        </div>
                        <div id="tampungData">
                        </div>
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Submit</span>
                            </button>
                            
                            {{-- <a href="{{ url('kasir/transaction/view', $ot->id) }}" target="_blank" class="btn btn-sm btn-flat btn-warning">Print<i class="fa fa-eye"></i></a> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $( '#uang_customer' ).mask('000.000.000.000', {reverse: true});
    let i = 0;
    let harga_sebelum = 0;
    $(document).on('click','#add-new-order',function(){
        let uang_customer = $('#uang_customer').val();
        uang_customer = uang_customer.split('.').join('');
        var barcode = $('#item').val();
        var stock = $('#stock').val();
        if(stock == '' || stock <= '0')
        alert('silahkan masukan stock dengan benar');
        if(stock !== '' && barcode !== '' && stock > '0')
        $.ajax({
            url: "{{ route('kasir.source.id') }}",
            method: 'post',
            dataType : 'json',
            data: {
                _token: $('[name="_token"]').val(),
                barcode : barcode
            },
            success : function(result){
                harga_sesudah = harga_sebelum + result[0]['price'] * stock;
                let template = `
                <div class="form-control mb-3 rounded remove_data">
                    <div class="row">
                        <input type="text" class="d-none barcode" name="item_id[${i}][item_id]" value="${result[0]['barcode']}">
                        <input type="number" class="d-none stock" name="item_id[${i}][stock]" value="${stock}">
                        <div class="col-7 d-inline-flex m-auto mb-auto">Nama item : ${result[0]['name']}</div>
                        <div class="col-4 d-inline-flex m-auto mb-auto">Stock dibeli : ${stock}</div>
                        <div class="col-1 d-inline-block">
                            <button type="button" class="btn btn-danger click_remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                </div>`;
                let container = $('#tampungData').append(template);
                let jumlah_kembalian = uang_customer - harga_sesudah;
                if(jumlah_kembalian < 0){
                    $('#mines').html('-');
                }else{
                    $('#mines').html('');
                }
                let jumlah_kembalian2 = jumlah_kembalian.toString().split('-').join('');
                $('#jumlah-kembalian').unmask();
                $('#jumlah-kembalian').html(jumlah_kembalian2);
                $('#jumlah-kembalian').mask('000.000.000.000', {reverse: true});
                $('#item').val('');
                $('#stock').val('');
                $('#jumlah_dibayar').unmask();
                $('#jumlah_dibayar').html(harga_sesudah);
                $('#jumlah_dibayar').mask('000.000.000.000', {reverse: true});
                $('#nama-item').val('');
                $('#stock-pertama').val('');
                $('#price-item').val('');
                harga_sebelum = harga_sesudah;
                i++;
            },
            error : function(){
                alert('cek lagi barcode pastikan terisi dengan tepat');
            }
        });
    });

    $(document).on('click','.click_remove',function(){
        var data_ini  = $(this).closest('.remove_data');
        var barcode = data_ini.find('.barcode').val();
        var stock = data_ini.find('.stock').val();
        let uang_customer = $('#uang_customer').val();
        uang_customer = uang_customer.split('.').join('');
        $.ajax({
            url: "{{ route('kasir.source.id') }}",
            method: 'post',
            dataType : 'json',
            data: {
                _token: $('[name="_token"]').val(),
                barcode : barcode
            },
            success : function(id){
                var harga_remove = id[0]['price'] * stock;
                var harga_sesudah = harga_sebelum - harga_remove;
                harga_sebelum = harga_sesudah;
                let jumlah_kembalian = uang_customer - harga_sesudah;
                if(jumlah_kembalian < 0){
                    $('#mines').html('-');
                }else{
                    $('#mines').html('');
                }
                let ubah_format = jumlah_kembalian.toString().split('-').join('');
                $('#jumlah_dibayar').unmask();
                $('#jumlah_dibayar').html(harga_sesudah);
                $( '#jumlah_dibayar' ).mask('000.000.000.000', {reverse: true});
                $( '#jumlah-kembalian' ).unmask();
                $('#jumlah-kembalian').html(ubah_format);
                $( '#jumlah-kembalian' ).mask('000.000.000.000', {reverse: true});
                data_ini.remove();
            }
        })
    })

    $(document).on('keyup' , '#uang_customer' , function(){
        let ilang_titik = $(this).val();
        let uang_customer = ilang_titik.split('.').join('');
        uang_customer = uang_customer - harga_sebelum;
        if(uang_customer < 0){
            $('#mines').html('-');
        }else{
            $('#mines').html('');
        }
        let ubah_format = uang_customer.toString().split('-').join('');
        $('#jumlah-kembalian').unmask();
        $('#jumlah-kembalian').html(ubah_format);
        $('#jumlah-kembalian').mask('000.000.000.000', {reverse: true});
    });

    $(document).on('click','#search-item',function(){
        var barcode = $('#item').val();
        $.ajax({
            url: "{{ route('kasir.source.id') }}",
            method: 'post',
            dataType : 'json',
            data: {
                _token: $('[name="_token"]').val(),
                barcode : barcode
            },
            success : function(result){
                $('#nama-item').val(result[0]['name']);
                $('#stock-pertama').val(result[1]);
                $('#price-item').val('RP. ' + result[0]['price']);
            },
            error : function(){
                alert('cek lagi barcode pastikan terisi dengan tepat');
            }
        });
    });


    $(document).on('click','[type="submit"]',function(){
        let ilang_titik = $('#uang_customer').val();
        let uang_customer = ilang_titik.split('.').join('');
        $('#uang_customer').val(uang_customer);
    });

    $(function(){
        let barcode_auto_complate = ["{!!  $items_barcode  !!}"];
        $('#item').autocomplete({
            source: barcode_auto_complate
        });
    });
</script>
@endsection