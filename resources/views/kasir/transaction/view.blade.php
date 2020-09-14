{{-- @if (\Auth::user()->role_users == 1 || \Auth::user()->role_users == 2) --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Fontfaces CSS-->
    <link href="{{ asset('css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/fontawesome-free-5.13.0/css/all.min.css') }}" rel="stylesheet"  media="all">
    <link href="{{ asset('vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
     <!-- Ionicons -->
     <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
     {{-- <!-- icheck bootstrap -->
     <link rel="stylesheet" href="{{asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
     <!-- Theme style -->
     <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
     <!-- Google Font: Source Sans Pro --> --}}
     <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
     <title>Print Invoice</title>
</head>
<body>
    <section class="content">
        ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
      <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
        <div class="card-body">
           <!-- Main content -->
           <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <i class="fas fa-globe"></i> KITA LAUNDRY
                  <small class="float-right">Cetak Nota: {{ $tgl }}</small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                {{ \Auth::user()->name }}
                <address>
                  <strong>{{ \Auth::user()->name }}</strong><br>
                  Jl. Hura-hura<br>
                  Kec. Ajaib, Kel. Suka-suka, Kota Impian<br>
                  Phone: 0812345123<br>
                  Email: test@gmail.com
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                Costumer
                
                    
                <address>
                  <strong>{{ $order->customers->name }}</strong><br>
                  {{ $order->customers->address }}<br>
                  Phone: {{ $order->customers->phone_number }}<br>
                  {{-- Email: {{ $dt->costumer->email }} --}}
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                No. Transaksi : <b>#{{ $order->invoice }}</b><br>
                {{-- ID Member : <b>#{{ $dt->costumer->id_member }}</b><br> --}}
                Tg. Transaksi : <b>{{ date('d F Y H:i:s', strtotime($order->created_at)) }}</b><br>
                {{-- Tg. Selesai   : <b>{{ date('d F Y H:i:s', strtotime($dt->updated_at)) }}</b> --}}
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            

            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Paket</th>
                    <th>Harga Barang</th>
                    <th>Jumlah Beli</th>
                    {{-- <th>Status Paket</th>
                    <th>Status Pesanan</th>
                    <th>Status Pembayaran</th>
                    <th>Berat /kg</th> --}}
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    
                    
                    @foreach ($order->order_details()->get() as $index=>$item)
                    <td>{{ $index+1 }}</td>
                    <td>{{ $item->items->name }}</td>
                    {{-- <td>{{ $order->order_details()->all()->items->name }}</td> --}}
                    {{-- <td>{{ $order->items->name }}</td> --}}
                    <td>{{ $item->items->price }}</td>
                    <td>{{ $item->qty }}</td>
                    @endforeach

                    
                    
                    {{-- <td>{{ $dt->status_pesanan->status }}</td>
                    <td>{{ $dt->status_pembayaran->status}}</td>
                    <td>{{ $dt->berat}} kg</td> --}}
                  </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <!-- accepted payments column -->
              <div class="col-8">
                <p class="lead"><b>Keterangan:</b></p>
                <p>Dihitung Berdasarkan :</p>
                <p>(Jenis laundry x berat) + Nama Paket + Status Paket</p>
                
              </div>
              <!-- /.col -->
              <div class="col-4">
                <div class="table-responsive">
                  {{-- <table class="table">
                    <th>Diskon :</th>
                    <td><strong>- Rp. {{number_format($dt->diskon->harga, 0)}}</strong></td>
                  </tr>
                </table> --}}
                  <table class="table">
                      <th>G.Total :</th>
                      <td><strong>Rp. {{ number_format($item->price, 0) }}</strong></td>
                      {{-- <td><strong>Rp. {{number_format($or->order_details()->find()->price, 0)}}</strong></td> --}}
                    </tr>
                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
                      
                  

            <div class="row no-print">
              <div class="col-12">
                <button onclick="window.print()" class="btn btn-primary float-right" style="margin-right: 5px;">
                  <i class="fas fa-print"></i> Print
                </button>
              </div>
            </div>

            <!-- this row will not appear when printing -->
          </div>
          <!-- /.invoice -->
        </div>
        </div>
        ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
      
    </section>
<!-- Jquery JS-->
<script src="{{ asset('vendor/jquery-3.2.1.min.js') }}"></script>
<!-- Bootstrap JS-->
<script src="{{ asset('vendor/bootstrap-4.1/popper.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
<!-- jquery mask -->
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<!-- Vendor JS   -->
<script src="{{ asset('vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('vendor/animsition/animsition.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
</script>
<script src="{{ asset('vendor/counter-up/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('vendor/counter-up/jquery.counterup.min.js') }}">
</script>
<script src="{{ asset('vendor/circle-progress/circle-progress.min.js') }}"></script>
<script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('vendor/chartjs/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/datepicker.js') }}"></script>

</body>
</html>
{{-- @else
<div class="card-body">
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <center>
        <h5><i class="icon fas fa-ban"></i> Maaf </h5>
        Halaman yang anda minta tidak ditemukan, ! <br>
        <a href="{{ url('dashboard') }}"> Kembali ke dashboard </a>
        </center>
    </div>
</div>    
@endif --}}
    

