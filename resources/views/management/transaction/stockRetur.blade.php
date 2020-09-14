@extends('management.layout.layout')
@section('judul')
    Stock Retur
@endsection
@section('content')
<div class="mt-3 row">
    <div class=" col-md-6 mb-1">
        <a class="btn btn-danger form-control" href="{{ route('management.transaction.stockRetur.pdf') }}" target="_blank">Export Stock Retur PDF <i class="fas fa-file-pdf"></i></a>
    </div>
    <div class=" col-md-6 mb-1">
        <a class="btn btn-success form-control" href="{{ route('management.transaction.stockRetur.excel') }}" target="_blank">Export Stock Retur Excel <i class="fas fa-file-excel"></i></a>
    </div>
</div>
<div class="mt-2">
    <div class="table-responsive table--no-card m-b-30">
        <table class="table table-borderless table-striped table-earning">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Barang Dari</th>
                    <th>Invoice</th>
                    <th>User</th>
                    <th>Customer</th>
                    <th>Name Item</th>
                    <th>Supplier</th>
                    <th>Stock</th>
                    <th>Expire</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Pengecekan</th>
                    <th>Item Create</th>
                    <th>Item Edit</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($stock_returs as $stock_retur)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $stock_retur->retur_dari === 'c' ? 'customer' : 'gudang' }}</td>
                        <td>{{ $stock_retur->invoice ?? 'kosong' }}</td>
                        <td>{{ $stock_retur->user_name ?? 'kosong'  }}</td>
                        <td>{{ $stock_retur->customers_name ?? 'kosong' }}</td>
                        <td>{{ $stock_retur->item_name }}</td>
                        <td>{{ $stock_retur->supplier_name ?? 'kosong' }}</td>
                        <td class="stock">{{ $stock_retur->stock }}</td>
                        <td>{{ $stock_retur->expire ? $stock_retur->expire->format('d-m-Y') : 'kosong' }}</td>
                        <td>{{ $stock_retur->price ? 'RP. ' : '' }}
                            <div class="d-inline-block price">{{ $stock_retur->price ?? 'kosong'}}</div>
                        </td>
                        <td>{{ $stock_retur->description }}</td>
                        <td>
                            {!! $stock_retur->pengecekan === 'p' ? '<p class="btn btn-warning">DiProses</p>' : '' !!}
                            {!! $stock_retur->pengecekan === 'ta' ? '<p class="btn btn-success">DiTerima</p>' : '' !!}
                            {!! $stock_retur->pengecekan === 'tk' ? '<p class="btn btn-danger">DiTolak</p>' : '' !!}
                        </td>
                        <td>{{ $stock_retur->created_at->format('d-m-Y') }}</td>
                        <td>{{ $stock_retur->updated_at ? $stock_retur->updated_at->format('d-m-Y') : 'kosong'  }}</td>
                        <td>
                            @if ($stock_retur->pengecekan !== 'p')
                                <form action="{{ route('management.transaction.stockRetur.destroy',$stock_retur->id) }}" method="POST" enctype="multipart/form-data" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @else
                            <form action="{{ route('management.transaction.stockRetur.proses.update',$stock_retur->id) }}" method="POST" enctype="multipart/form-data" class="d-inline-block">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success" name="proses" value="ta">Terima</button>
                            </form>
                            <form action="{{ route('management.transaction.stockRetur.proses.update',$stock_retur->id) }}" method="POST" enctype="multipart/form-data" class="d-inline-block">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger" name="proses" value="tk">Tolak</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('script')
    <script>
        $('.price').mask('000.000.000.000', {reverse: true});
        $('.stock').mask('000.000.000.000',{reverse:true});
    </script>
@endsection