@extends('admin.main')
@section('head')
@endsection

@section('content')
    <form action="{{ route('admin.products.postedit') }}" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tên Sản Phẩm</label>
                        <input type="text" name="name" value="{{ $proEdit->name }}" class="form-control"
                            placeholder="Nhập tên sản phẩm">
                    </div>
                    @error('name')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Danh Mục</label>
                        <select class="form-control" name="menu_id">
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}" {{ $proEdit->menu_id == $menu->id ? 'selected' : '' }}>
                                    {{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Giá Gốc</label>
                        <input type="number" name="price" value="{{ $proEdit->price }}" class="form-control">
                    </div>
                    @error('price')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Giá Giảm</label>
                        <input type="number" name="price_sale" value="{{ $proEdit->price_sale }}" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Mô Tả </label>
                <textarea name="description" class="form-control">{{ $proEdit->description }}</textarea>
            </div>
            @error('description')
                <p style="color: red">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label>Mô Tả Chi Tiết</label>
                <textarea name="content" id="content" class="form-control">{{ $proEdit->content }}</textarea>
            </div>
            @error('content')
                <p style="color: red">{{ $message }}</p>
            @enderror
                <div class="form-group">
                    <label for="hinhanh">Ảnh Sản Phẩm</label>
                    <input type="file" class="form-control" id="hinhanh" name="hinhanh" value="" placeholder="">
                    <div id="image_show">
                        <a href="{{ asset('image') }}/{{ $proEdit->thumb }}">
                            <img src="{{ asset('image') }}/{{ $proEdit->thumb }}" width="110" height="100">
                        </a>
                    </div>
                    <input type="hidden" name="thumb" id="thumb">
                </div>
                @error('hinhanh')
                <p style="color: red">{{ $message }}</p>
            @enderror
            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        {{ $proEdit->active == 1 ? 'checked=""' : '' }}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                        {{ $proEdit->active == 0 ? 'checked=""' : '' }}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>


        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật Sản Phẩm</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        ClassicEditor.create(document.querySelector('#content')).catch(erro => {
            console.error(error);
        });
    </script>
@endsection
