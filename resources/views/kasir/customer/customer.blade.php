@extends('kasir.layout.layout')
@section('judul')
    Customers
@endsection
@section('btn_add')
<a href="{{ route('kasir.customer.create') }}" class="au-btn au-btn-icon au-btn--blue">
    <i class="zmdi zmdi-plus"></i>add customer
</a>
@endsection
@section('content')
<div class="mt-3 row">
    <div class=" col-md-6 mb-1">
        <a class="btn btn-danger form-control" href="{{ route('kasir.customer.pdf') }}" target="_blank">Export Customer PDF <i class="fas fa-file-pdf"></i></a>
    </div>
    <div class=" col-md-6 mb-1">
        <a class="btn btn-success form-control" href="{{ route('kasir.customer.excel') }}" target="_blank">Export Customer Excel <i class="fas fa-file-excel"></i></a>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive table--no-card m-b-30">
            <table class="table table-borderless table-striped table-earning">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>gender</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Date Created</th>
                        <th>Date Edit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->gender }}</td>
                            <td>{{ $customer->phone_number }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->created_at->format('d-m-Y') }}</td>
                            <td>{{ $customer->updated_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('kasir.customer.show_edit',$customer->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('kasir.customer.destroy',$customer->id) }}" method="post" enctype="multipart/form-data" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                            </td>
                        </tr>
                    @empty
                        <td colspan="8"><h3 >MAAF DATA CUSTOMER BELUM ADA</h3></td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>
@endsection