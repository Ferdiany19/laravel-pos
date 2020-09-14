<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Bootstrap CSS-->
    {{-- <link href="{{ asset('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all"> --}}
    {{-- <!-- Main CSS-->
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet" media="all"> --}}
    <style>
        body{
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
        }
            .card{
                margin-bottom: 10px;
                position: relative;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-direction: column;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 1px solid rgba(0,0,0,.125);
                border-radius: .25rem;
            }
    
            .card .card-body{
                flex: 1 1 auto;
                padding: 1.25rem;
            }
            .text-center{
                text-align: center!important;
            }
    
            h4{
                font-size: 1.5rem;
                margin-bottom: .5rem;
                font-weight: 500;
                line-height: 1.2;
                margin-top: 0;
            }
    
            .card .card-header{
                padding: .75rem 1.25rem;
                margin-bottom: 0;
                background-color: rgba(0,0,0,.03);
                border-bottom: 1px solid rgba(0,0,0,.125);
            }
            .d-inline-block{
                display: inline-block;
            }
            .mt-2{
                margin-top: .5rem!important;
            }
            .row{
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
                margin-right: -15px;
                margin-left: -15px;
            }
                .col-lg-6 {
                    -ms-flex: 0 0 47%;
                    flex: 0 0 47%;
                    max-width: 47%;
                }
            
            .col-lg-6 {
                position: relative;
                width: 100%;
                min-height: 1px;
                padding-right: 15px;
                padding-left: 15px;
            }

            .col-lg-12,.col-12 {
                -ms-flex: 0 0 97.4%;
                flex: 0 0 97.4%;
                max-width: 97.4%;
            }
            .mt-full{
                margin-top: 550px;
            }
        </style>
</head>
<body>
    <div class="row mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body"><div class="text-center"><h4>RP. {{ $pemasukan < 0 ? '-' : '' }}<div class="d-inline-block price">{{ $pemasukan < 0 ? - $pemasukan : $pemasukan }}</div></h4></div></div>
                <div class="card-header"><div class="text-center">
                    Pemasukann <br>
                    ini adalah jumlah pemasukan yang sudah di beli atau yang terjual
                </div></div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body"><div class="text-center"><h4>RP. {{ $laba < 0 ? '-' : '' }}<div class="d-inline-block price">{{ $laba < 0 ? - $laba : $laba  }}</div></h4></div></div>
                <div class="card-header"><div class="text-center">
                    Laba <br>
                    ini adalah keuntungan dari pemasukan atau yang sudah terjual
                </div></div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body"><div class="text-center"><h4>RP. {{ $belum_terjual < 0 ? '-' : '' }}<div class="d-inline-block price">{{ $belum_terjual < 0 ? - $belum_terjual : $belum_terjual }}</div></h4></div></div>
                <div class="card-header"><div class="text-center">
                    Belum Terjual <br>
                    ini adalah jumlah barang yang belum terjual atau belum laku
                </div></div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body"><div class="text-center"><h4>RP. {{ $retur_pemasukan < 0 ? '-' : '' }}<div class="d-inline-block price">{{ $retur_pemasukan < 0 ? - $retur_pemasukan : $retur_pemasukan }}</div></h4></div></div>
                <div class="card-header"><div class="text-center">
                    Retur Pemasukan <br>
                    ini adalah jumlah retur dari penjualan barang yang terjual atau dari cutomer
                </div></div>
            </div>
        </div>
        <div class="col-lg-12 mt-full">
            <div class="card">
                <div class="card-body"><div class="text-center"><h4>RP. {{ $retur_pengeluaran < 0 ? '-' : '' }}<div class="d-inline-block price">{{ $retur_pengeluaran < 0 ? - $retur_pengeluaran : $retur_pengeluaran }}</div></h4></div></div>
                <div class="card-header"><div class="text-center">
                    Retur Pengeluaran <br>
                    ini adalah jumlah retur dari gudang
                </div></div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body"><div class="text-center"><h4>RP. {{ $pengeluaran < 0 ? '-' : '' }}<div class="d-inline-block price">{{ $pengeluaran < 0 ? - $pengeluaran : $pengeluaran }}</div></h4></div></div>
                <div class="card-header"><div class="text-center">
                    Pengeluaran <br>
                    ini adalah jumlah dari pengeluaran semua untuk membeli barang
                </div></div>
            </div>
        </div>
    </div>
</body>
</html>