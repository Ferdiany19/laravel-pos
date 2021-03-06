@extends('management.layout.layout')
@section('judul')
    Finance
@endsection
@section('content')
<div class="mt-3 row">
    <div class=" col-md-6 mb-1">
        <a class="btn btn-danger form-control" href="{{ route('management.finance.akumulasi.pdf') }}" target="_blank">Export Akumulasi PDF <i class="fas fa-file-pdf"></i></a>
    </div>
    <div class=" col-md-6 mb-1">
        <a class="btn btn-success form-control" href="{{ route('management.finance.akumulasi.excel') }}" target="_blank">Export Akumulasi Excel <i class="fas fa-file-excel"></i></a>
    </div>
</div>
    <div class="row mt-2">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body"><div class="text-center"><h4>RP. <div class="d-inline-block price">{{ $pemasukan }}</div></h4></div></div>
                <div class="card-header"><div class="text-center">
                    Pemasukann <br>
                    ini adalah jumlah pemasukan yang sudah di beli atau yang terjual
                </div></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body"><div class="text-center"><h4>RP. <div class="d-inline-block price">{{ $laba }}</div></h4></div></div>
                <div class="card-header"><div class="text-center">
                    Laba <br>
                    ini adalah keuntungan dari pemasukan atau yang sudah terjual
                </div></div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body"><div class="text-center"><h4>RP. <div class="d-inline-block price">{{ $belum_terjual }}</div></h4></div></div>
                <div class="card-header"><div class="text-center">
                    Belum Terjual <br>
                    ini adalah jumlah barang yang belum terjual atau belum laku
                </div></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body"><div class="text-center"><h4>RP. <div class="d-inline-block price">{{ $retur_pemasukan }}</div></h4></div></div>
                <div class="card-header"><div class="text-center">
                    Retur Pemasukan <br>
                    ini adalah jumlah retur dari penjualan barang yang terjual atau dari cutomer
                </div></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body"><div class="text-center"><h4>RP. <div class="d-inline-block price">{{ $retur_pengeluaran }}</div></h4></div></div>
                <div class="card-header"><div class="text-center">
                    Retur Pengeluaran <br>
                    ini adalah jumlah retur dari gudang
                </div></div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body"><div class="text-center"><h4>RP. <div class="d-inline-block price">{{ $pengeluaran }}</div></h4></div></div>
                <div class="card-header"><div class="text-center">
                    Pengeluaran <br>
                    ini adalah jumlah dari pengeluaran semua untuk membeli barang
                </div></div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.price').mask('000.000.000.000.000', {reverse: true});
    </script>
@endsection