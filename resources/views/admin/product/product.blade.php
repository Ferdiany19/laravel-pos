@extends('admin.layout.layout')
@section('judul')
    Product
@endsection
@section('content')
<div class="main-content p-3">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                {{-- ---------------------------- Table Category --------------------------- --}}
                <div class="col-lg-6">
                    <div class="d-flex bg-white pb-2 pt-2 rounded">
                        <label for="" class="mb-auto mt-auto ml-4">Category</label>
                        <button type="button" class="btn btn-primary ml-auto mb-auto mt-auto mr-2" id="addCategory"  data-toggle="modal" data-target="#modalAddCategory"><i class="zmdi zmdi-plus"></i> ADD CATEGORY</button>
                    </div> 
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($categorys as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <form action="{{ route('admin.category.destroy',$category->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">DELETE</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">Data Category Kosong</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- --------------------------------------------------------------------------------- --}}
                {{-- -------------------------- TABLE UNIT ---------------------------------------- --}}
                <div class="col-lg-6">
                    <div class="d-flex bg-white pb-2 pt-2 rounded">
                        <label for="" class="mb-auto mt-auto ml-4">Unit</label>
                        <button type="button" class="btn btn-primary ml-auto mb-auto mt-auto mr-2" id="addUnit" data-toggle="modal" data-target="#modalAddUnit"><i class="zmdi zmdi-plus"></i> ADD UNIT</button>
                    </div>
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($units as $unit)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $unit->name }}</td>
                                        <td>
                                            <form action="{{ route('admin.unit.destroy',$unit->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">DELETE</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Data Unit Kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- --------------------------------------------------------------------- --}}
                {{-- ----------------------------- TABLE ITEM ------------------------------------ --}}
                <div class="col-12">
                    <div class="d-flex bg-white pb-2 pt-2 rounded-top">
                        <label for="" class="mb-auto mt-auto ml-4">Item</label>
                        <a href="{{ route('admin.item.create') }}" class="btn btn-primary ml-auto mb-auto mt-auto mr-2"><i class="zmdi zmdi-plus"></i> ADD ITEM</a>
                    </div>
                    <div class="bg-white rounded-bottom">
                        <div class="row mx-auto pb-2">
                            <div class="col-md-6 mb-1">
                                <a class="btn btn-danger form-control" href="{{ route('admin.product.allBarcode.pdf') }}" target="_blank">Export ALL Barcode PDF <i class="fas fa-file-pdf"></i></a>
                            </div>
                            <div class="col-md-6 mb-1">
                                <a class="btn btn-danger form-control" href="{{ route('admin.product.pdf') }}" target="_blank">Export Product PDF <i class="fas fa-file-pdf"></i></a>
                            </div>
                            <div class="col-12">
                                <a class="btn btn-success form-control" href="{{ route('admin.product.excel') }}" target="_blank">Export Product Excel <i class="fas fa-file-excel"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <th>No</th>
                                <th>barcode</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Unit</th>
                                <th>Price</th>
                                <th>Method Stock</th>
                                <th>Image</th>
                                <th>Date Created</th>
                                <th>Date Edit</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->barcode }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->categorys()->first()->name }}</td>
                                        <td>{{ $item->units()->first()->name }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->method_stock }}</td>
                                        <td>{{ $item->image }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.item.show',$item->id) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('admin.item.destroy',$item->id) }}" method="POST" enctype="multipart/form-data" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12">Data Masih Kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- ----------------------------------------------------------------- --}}
            </div>
        </div>
    </div>
</div>
@endsection
{{-- ------------------------------------------ MODAL --------------------------- --}}
@section('modals')
<div class="modal fade" id="modalAddCategory" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true" style="z-index: ">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollmodalLabel">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nameCategory" class="control-label mb-1">Name</label>
                        <input type="text" name="name" id="nameCategory" class="form-control" aria-invalid="false" aria-required="true">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalAddUnit" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true" style="z-index: ">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollmodalLabel">Add Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.unit.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nameUnit" class="control-label">Name</label>
                        <input type="text" name="name" id="nameUnit" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection