@extends('admin.layouts.main')
@section('head')
@endsection
@section('content')
    <form action="{{ route('admin.taikhoan.update', [$taikhoan]) }}" method="post">
        @csrf
        @method('put')

        <div class="card-body">
            <div class="form-group">
                <label>Họ và tên</label>
                <input type="text" name="name" class="form-control" value="{{ $taikhoan->name }}"
                    placeholder="Nhập họ và tên">
            </div>
            @error('name')
                <p style="color: red">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label>Số điện thoại</label>
                <input type="text" name="sdt" class="form-control" value="{{ $taikhoan->sdt }}"
                    placeholder="Nhập số điện thoại">
            </div>
            @error('sdt')
                <p style="color: red">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ $taikhoan->email }}" placeholder="Nhập email" required />
            </div>
            @error('email')
                <p style="color: red">{{ $message }}</p>
            @enderror

            <div class="form-group" data-select2-id="29">
                <label>Tên vai trò</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1"
                    tabindex="-1" aria-hidden="true" name="vaitro_id">
                    <option selected="selected" data-select2-id="3" value="">Chọn tên vai trò</option>
                    @foreach ($vaitro as $value)
                        @if ($value->id == $taikhoan->getVaiTro[0]->id)
                            <option selected="selected" value="{{ $value->id }}">{{ $value->tenvaitro }}</option>
                        @else
                            <option value="{{ $value->id }}">{{ $value->tenvaitro }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            @error('vaitro_id')
                <p style="color: red">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label>Kích Hoạt</label>
                @if ($taikhoan->status == 'active')
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="active" type="radio" id="active" name="status"
                            checked>
                        <label for="active" class="custom-control-label">Hoạt động</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="inactive" type="radio" id="no_active" name="status">
                        <label for="no_active" class="custom-control-label">Không hoạt động</label>
                    </div>
                @else
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="active" type="radio" id="active" name="status">
                        <label for="active" class="custom-control-label">Hoạt động</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="inactive" type="radio" id="no_active" name="status"
                            checked>
                        <label for="no_active" class="custom-control-label">Không hoạt động</label>
                    </div>
                @endif
            </div>
            <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" id="change_password_checkbox"
                    name="change_password_checkbox" />
                <label class="form-check-label" for="change_password_checkbox">Đổi mật khẩu</label>
            </div>

            <div id="change_password_group">
                <div class="mb-3">
                    <label class="form-label" for="password">Mật khẩu mới</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" />
                    @error('password')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password_confirmation">Xác nhận mật khẩu mới</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                        id="password_confirmation" name="password_confirmation" />
                    @error('password_confirmation')
                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>
            </div>


            <div class="">
                <button type="submit" class="btn btn-primary">Lưu tài khoản</button>
            </div>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#change_password_group").hide();
            $("#change_password_checkbox").change(function() {
                if ($(this).is(":checked")) {
                    $("#change_password_group").show();
                    $("#change_password_group :input").attr("required", "required");
                } else {
                    $("#change_password_group").hide();
                    $("#change_password_group :input").removeAttr("required");
                }
            });
        });
    </script>
@endsection
