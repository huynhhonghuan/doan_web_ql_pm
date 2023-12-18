@extends('admin.layouts.main')
@section('head')
@endsection
@section('content')
    <form action="{{ route('admin.taikhoan.store') }}" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Họ và tên</label>
                <input type="text" name="name" class="form-control" placeholder="Nhập họ và tên">
            </div>
            @error('name')
                <p style="color: red">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label>Số điện thoại</label>
                <input type="text" name="sdt" class="form-control" placeholder="Nhập số điện thoại">
            </div>
            @error('sdt')
                <p style="color: red">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ old('email') }}" placeholder="Nhập email" required />
            </div>
            @error('email')
                <p style="color: red">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" placeholder="Nhập mật khẩu" required />
            </div>

            @error('password')
                <p style="color: red">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label>Xác nhận mật khẩu</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                    id="password_confirmation" name="password_confirmation" placeholder=" Xác nhận mật khẩu" required />
            </div>

            @error('password_confirmation')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror

            <div class="form-group" data-select2-id="29">
                <label>Tên vai trò</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1"
                    tabindex="-1" aria-hidden="true" name="vaitro_id">
                    <option selected="selected" data-select2-id="3" value="">Chọn tên vai trò</option>
                    @foreach ($vaitro as $value)
                        <option value="{{ $value->id }}">{{ $value->tenvaitro }}</option>
                    @endforeach
                </select>
            </div>
            @error('vaitro_id')
                <p style="color: red">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="active" type="radio" id="active" name="status"
                        checked="">
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="inactive" type="radio" id="no_active" name="status">
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

            <div class="">
                <button type="submit" class="btn btn-primary">Tạo tài khoản</button>
            </div>
        </div>
        @csrf
    </form>
@endsection
