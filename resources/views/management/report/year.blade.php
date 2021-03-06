@extends('management.layout.layout')
@section('judul')
    Report Year
@endsection
@section('content')
<section>
    <div class="card mt-5">
        <div class="card-header">
            <h4 class="text-center">Show</h4>
        </div>
        <div class=" card-body">
            <div class="input-group">
                @csrf
                <input type="text" name="search_year" id="datepicker" class="form-control docs-date" placeholder="dd/mm/yyyy" autocomplete="off" value="{{ now()->format('Y') }}">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-info" id="search-day">Search</button>
                </div>
            </div>
            <div class="mt-3 row">
                <div class="col-md-6 mb-1">
                    <button class="btn btn-danger form-control" id="pdf">Export Report Year PDF <i class="fas fa-file-pdf"></i></button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-success form-control" id="excel">Export Report Year Excel <i class="fas fa-file-excel"></i></button>
                </div>
            </div>
            <div class="table-responsive table--no-card m-b-30 mt-2">
                <table class="table table-borderless table-striped table-earning">
                    <thead>
                        <th>No</th>
                        <th>Invoice</th>
                        <th>Nama Item</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Laba</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->invoice }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->laba }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">Maaf Belum Ada Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
$( function() {
    $( "#datepicker" ).datepicker({
    autoHide: true,
    format: 'yyyy',
    showOtherMonths: true,
    selectOtherMonths: true
    });
} );
$( "#datepicker" ).mask('0000');

$(document).on('click','#search-day',function(){
    let search_year = $('[name="search_year"]').val();
    search_year = search_year.split('/').join('-');
    let _token = $('[name="_token"]').val();
    $('tbody').html(`
    <tr>
        <td colspan="8">Proses</td>
    </tr>
    `);
    $.ajax({
        url : "{{ route('management.report.year.search') }}",
        method: 'post',
        dataType: "json",
        data: {
            _token : _token,
            year : search_year
        },success: function(result){
            if((result.length) > 0){
                let i = 0;
                let no = 0;
                $.each(result,function(){
                    $('tbody').html(`
                    <tr>
                        <td>${++no}</td>
                        <td>${result[i]['invoice']}</td>
                        <td>${result[i]['name']}</td>
                        <td>${result[i]['qty']}</td>
                        <td>${result[i]['price']}</td>
                        <td>${result[i]['laba']}</td>
                        <td>${$.datepicker.formatDate('dd-mm-yy',new Date(result[i]['created_at']))}</td>
                        <td>${$.datepicker.formatDate('dd-mm-yy',new Date(result[i++]['updated_at']))}</td>
                    </tr>
                    `);
                });
            }else{
                $('tbody').html(`
                <tr>
                    <td colspan="8">Maaf Belum Ada Data</td>
                </tr>
                `);
            }
        }
    });
});

$(document).on('click','#pdf',function(){
    let search_year = $('[name="search_year"]').val();
    search_year = search_year.split('/').join('-');
    window.open(`{{ route("management.report.year.index",) }}/pdf/${search_year}`)
});

$(document).on('click','#excel',function(){
    let search_year = $('[name="search_year"]').val();
    search_year = search_year.split('/').join('-');
    window.open(`{{ route("management.report.year.index",) }}/excel/${search_year}`)
});
</script>
@endsection