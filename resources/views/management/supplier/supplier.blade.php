@extends('management.layout.layout')
@section('judul')
    Suppliers
@endsection
@section('btn_add')
<a href="{{ route('management.supplier.create') }}" class="au-btn au-btn-icon au-btn--blue">
    <i class="zmdi zmdi-plus"></i>add supplier
</a>
@endsection
@section('content')
<div class="mt-3 row">
    <div class=" col-md-6 mb-1">
        <a class="btn btn-danger form-control" href="{{ route('management.supplier.pdf') }}" target="_blank">Export Supplier PDF <i class="fas fa-file-pdf"></i></a>
    </div>
    <div class=" col-md-6 mb-1">
        <a class="btn btn-success form-control" href="{{ route('management.supplier.excel') }}" target="_blank">Export Supplier Excel <i class="fas fa-file-excel"></i></a>
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
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Description</th>
                        <th>Date Created</th>
                        <th>Date Edit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($suppliers as $supplier)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->phone_number }}</td>
                            <td>{{ $supplier->address }}</td>
                            <td>{{ $supplier->description }}</td>
                            <td>{{ $supplier->created_at->format('d-m-Y') }}</td>
                            <td>{{ $supplier->updated_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('management.supplier.show_edit',$supplier->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('management.supplier.destroy',$supplier->id) }}" method="post" enctype="multipart/form-data" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                            </td>
                        </tr>
                    @empty
                        <td colspan="8"><h3 >MAAF DATA SUPPLIER BELUM ADA</h3></td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>
@endsection