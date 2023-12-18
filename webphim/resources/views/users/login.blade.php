<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.head')
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Đăng nhập</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Đăng nhập</p>
                @include('layout.alert')
                <form action="{{ route('users.postlogin') }}" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                    <div class="row">
                        <div class="col-8">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">Ghi nhớ</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" style="width: 103%">Đăng
                                nhập</button>
                        </div>
                        @csrf
                    </div>
                </form>

                {{-- <div class="social-auth-links text-center mb-3">
        <p>- Hoặc -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Đăng nhập bằng Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Đăng nhập bằng Google+
        </a>
      </div>

      <p class="mb-1">
        <a href="forgot-password.html">Quên mật khẩu</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Đăng ký</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div> --}}
                <!-- /.login-box -->
                @include('layout.footer')
</body>

</html>
