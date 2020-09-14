@extends('admin.layout.layout')
@section('judul')
    Users
@endsection
@section('btn_add')
<a href="{{ route('admin.user.create') }}" class="au-btn au-btn-icon au-btn--blue">
    <i class="zmdi zmdi-plus"></i>add User
</a>
@endsection
@section('content')
    <section>
        <div class="mt-3 row">
            <div class="col-md-6 mb-1">
                <a class="btn btn-danger form-control" href="{{ route('admin.user.pdf') }}" target="_blank">Export User PDF <i class="fas fa-file-pdf"></i></a>
            </div>
            <div class="col-md-6 mb-1">
                <a class="btn btn-success form-control" href="{{ route('admin.user.excel') }}" target="_blank">Export User Excel <i class="fas fa-file-excel"></i></a>
            </div>
        </div>
        <div class="mt-2">
            <div class="table-responsive table--no-card m-b-30">
                <table class="table table-borderless table-striped table-earning">
                    <thead>
                        <th>No</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Role User</th>
                        <th>Image</th>
                        <th>Address</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->user_profiles()->first()->fullname }}</td>
                                <td>{{ $user->user_profiles()->first()->gender === 'm' ? 'male' : 'female'}}</td>
                                <td>{{ $user->user_profiles()->first()->phone_number }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role_users()->first()->name }}</td>
                                <td>{{ $user->user_profiles()->first()->image }}</td>
                                <td>{{ $user->user_profiles()->first()->address }}</td>
                                <td>{{ $user->user_profiles()->first()->created_at }}</td>
                                <td>{{ $user->user_profiles()->first()->updated_at }}</td>
                                <td>
                                    <a href="{{ route('admin.user.show',$user->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('admin.user.delete',$user->id) }}" method="POST" enctype="multipart/form-data" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">Maaf Data Belum Ada</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection