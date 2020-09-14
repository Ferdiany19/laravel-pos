@extends('admin.layout.layout')
@section('judul')
    Users
@endsection
@section('content')
    <section class="mt-4">
        <div class="card">
            <div class="card-header text-center">Create User</div>
            <div class="card-body">
                <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label mb-1">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="gender" class="control-label mb-1">gender</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="">--pilih--</option>
                            <option value="m">Male</option>
                            <option value="f">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone_number" class="control-label mb-1">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label mb-1">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label mb-1">Password</label>
                        <input type="text" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="role_user" class="control-label mb-1">Role User</label>
                        <select name="role_user" id="role_user" class="form-control">
                            <option value="">--pilih--</option>
                            @forelse ($role_users as $role_user)
                                <option value="{{ $role_user->id }}">{{ $role_user->name }}</option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label mb-1">address</label>
                        <textarea name="address" id="address" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="image" class="form-control-label">Image</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" name="image" id="image" class="form-control-file">
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-lg btn-info btn-block" id="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $('#phone_number').mask('0000-0000-0000-0000');
        $(document).on('click','button[type="submit"]#submit',function(){
            let phone_number =  $('#phone_number').val();
            phone_number = phone_number.split('-').join('');
            $('#phone_number').val(phone_number);
        });
    </script>
@endsection