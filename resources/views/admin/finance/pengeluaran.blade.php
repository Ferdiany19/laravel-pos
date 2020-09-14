@extends('admin.layout.layout')
@section('judul')
    Finance
@endsection
@section('content')
    <div class="mt-5">
        <div class="card">
            <div class="card-header"><h4 class="text-center">Show</h4></div>
            <div class="card-body">
                <select id="select-table" class="form-control mb-2">
                    <option value="table-pengeluaran" selected>Pengeluaran</option>
                    <option value="table-pemasukan">Pemasukan</option>
                    <option value="table-laba">Laba</option>
                    <option value="table-belum-terjual">Belum Terjual</option>
                    <option value="table-retur-pemasukan">Retur Pemasukan</option>
                    <option value="table-retur-pengeluaran">Retur Pengeluaran</option>
                </select>
                <div id="kumpulan-table">
                    <div id="table-pengeluaran">
                        <div class="mt-3 row">
                            <div class="col-md-6 mb-1">
                                <a class="btn btn-danger form-control" href="{{ route('admin.finance.pengeluaran.pdf') }}" target="_blank">Export Pengeluaran PDF <i class="fas fa-file-pdf"></i></a>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-success form-control" href="{{ route('admin.finance.pengeluaran.excel') }}" target="_blank">Export Pengeluaran Excel <i class="fas fa-file-excel"></i></a>
                            </div>
                        </div>
                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name Item</th>
                                        <th>Stock</th>
                                        <th>price</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pengeluarans as $pengeluaran)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->find($pengeluaran->item_id)->name ?? $pengeluaran->item_name }}</td>
                                            <td class="format">{{ $pengeluaran->stock ?? $pengeluaran->qty }}</td>
                                            <td>RP. {{ $pengeluaran->price < 0 ? '-' : '' }}<div class="format d-inline-block">{{ $pengeluaran->price < 0 ? - $pengeluaran->price : $pengeluaran->price }}</div></td>
                                            <td>{{ $pengeluaran->created_at }}</td>
                                            <td>{{ $pengeluaran->updated_at }}</td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">Maaf Kosong</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="table-pemasukan"  style="display: none">
                        <div class="mt-3 row">
                            <div class="col-md-6 mb-1">
                                <a class="btn btn-danger form-control" href="{{ route('admin.finance.pemasukan.pdf') }}" target="_blank">Export Pemasukan PDF <i class="fas fa-file-pdf"></i></a>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-success form-control" href="{{ route('admin.finance.pemasukan.excel') }}" target="_blank">Export Pemasukan Excel <i class="fas fa-file-excel"></i></a>
                            </div>
                        </div>
                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name Item</th>
                                        <th>Stock</th>
                                        <th>price</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pemasukans as $pemasukan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->find($pemasukan->item_id)->name ?? $pemasukan->item_name }}</td>
                                            <td class="format">{{ $pemasukan->stock ?? $pemasukan->qty }}</td>
                                            <td>RP. {{ $pemasukan->price < 0 ? '-' : '' }}<div class="format d-inline-block">{{ $pemasukan->price < 0 ? - $pemasukan->price : $pemasukan->price }}</div></td>
                                            <td>{{ $pemasukan->created_at }}</td>
                                            <td>{{ $pemasukan->updated_at }}</td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">Maaf Kosong</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div  id="table-laba" style="display: none">
                        <div class="mt-3 row">
                            <div class="col-md-6 mb-1">
                                <a class="btn btn-danger form-control" href="{{ route('admin.finance.laba.pdf') }}" target="_blank">Export Laba PDF <i class="fas fa-file-pdf"></i></a>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-success form-control" href="{{ route('admin.finance.laba.excel') }}" target="_blank">Export Laba Excel <i class="fas fa-file-excel"></i></a>
                            </div>
                        </div>
                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name Item</th>
                                        <th>Stock</th>
                                        <th>price</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pemasukans as $pemasukan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->find($pemasukan->item_id)->name ?? $pemasukan->item_name }}</td>
                                            <td class="format">{{ $pemasukan->stock ?? $pemasukan->qty }}</td>
                                            <td>RP. {{ $pemasukan->laba < 0 ? '-' : '' }}<div class="format d-inline-block">{{ $pemasukan->laba < 0 ? - $pemasukan->laba : $pemasukan->laba }}</div></td>
                                            <td>{{ $pemasukan->created_at }}</td>
                                            <td>{{ $pemasukan->updated_at }}</td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">Maaf Kosong</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="table-belum-terjual" style="display: none">
                        <div class="mt-3 row">
                            <div class="col-md-6 mb-1">
                                <a class="btn btn-danger form-control" href="{{ route('admin.finance.belum-terjual.pdf') }}" target="_blank">Export Belum Terjual PDF <i class="fas fa-file-pdf"></i></a>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-success form-control" href="{{ route('admin.finance.belum-terjual.excel') }}" target="_blank">Export Belum Terjual Excel <i class="fas fa-file-excel"></i></a>
                            </div>
                        </div>
                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name Item</th>
                                        <th>Stock</th>
                                        <th>price</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($belum_terjuals as $belum_terjual)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->find($belum_terjual->item_id)->name ?? $belum_terjual->item_name }}</td>
                                            <td class="format">{{ $belum_terjual->stock ?? $belum_terjual->qty }}</td>
                                            <td>RP. {{ $belum_terjual->price < 0 ? '-' : '' }}<div class="format d-inline-block">{{ $belum_terjual->price < 0 ? - $belum_terjual->price : $belum_terjual->price }}</div></td>
                                            <td>{{ $belum_terjual->created_at }}</td>
                                            <td>{{ $belum_terjual->updated_at }}</td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">Maaf Kosong</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="table-retur-pemasukan" style="display: none">
                        <div class="mt-3 row">
                            <div class="col-md-6 mb-1">
                                <a class="btn btn-danger form-control" href="{{ route('admin.finance.retur-pemasukan.pdf') }}" target="_blank">Export Retur Pemasukan PDF <i class="fas fa-file-pdf"></i></a>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-success form-control" href="{{ route('admin.finance.retur-pemasukan.excel') }}" target="_blank">Export Retur Pemasukan Excel <i class="fas fa-file-excel"></i></a>
                            </div>
                        </div>
                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name Item</th>
                                        <th>Stock</th>
                                        <th>price</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($retur_pemasukans as $retur_pemasukans)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->find($retur_pemasukans->item_id)->name ?? $retur_pemasukans->item_name }}</td>
                                            <td class="format">{{ $retur_pemasukans->stock ?? $retur_pemasukans->qty }}</td>
                                            <td>RP. {{ $retur_pemasukans->price < 0 ? '-' : '' }}<div class="format d-inline-block">{{ $retur_pemasukans->price < 0 ? - $retur_pemasukans->price : $retur_pemasukans->price }}</div></td>
                                            <td>{{ $retur_pemasukans->created_at }}</td>
                                            <td>{{ $retur_pemasukans->updated_at }}</td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">Maaf Kosong</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="table-retur-pengeluaran" style="display: none">
                        <div class="mt-3 row">
                            <div class="col-md-6 mb-1">
                                <a class="btn btn-danger form-control" href="{{ route('admin.finance.retur-pengeluaran.pdf') }}" target="_blank">Export Retur Pengeluaran PDF <i class="fas fa-file-pdf"></i></a>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-success form-control" href="{{ route('admin.finance.retur-pengeluaran.excel') }}" target="_blank">Export Retur Pengeluaran Excel <i class="fas fa-file-excel"></i></a>
                            </div>
                        </div>
                        <div class="table-responsive table--no-card m-b-30">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name Item</th>
                                        <th>Stock</th>
                                        <th>price</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($retur_pengeluarans as $retur_pengeluaran)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->find($retur_pengeluaran->item_id)->name ?? $retur_pengeluaran->item_name }}</td>
                                            <td class="format">{{ $retur_pengeluaran->stock ?? $retur_pengeluaran->qty }}</td>
                                            <td>RP. {{ $retur_pengeluaran->price < 0 ? '-' : '' }}<div class="format d-inline-block">{{ $retur_pengeluaran->price < 0 ? - $retur_pengeluaran->price : $retur_pengeluaran->price }}</div></td>
                                            <td>{{ $retur_pengeluaran->created_at }}</td>
                                            <td>{{ $retur_pengeluaran->updated_at }}</td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">Maaf Kosong</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let table = 'table-pengeluaran';
        $(document).on('change','#select-table',function(){
            $('#' + table).hide();
            table = $(this).val();
            $('#' + table).show();
        });
        $('.format').mask('000.000.000.000',{reverse : true});
    </script>
@endsection