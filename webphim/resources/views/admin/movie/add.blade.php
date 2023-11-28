@extends('admin.main')
@section('head')
<style>
    .preview-upload {
        border: 1px dashed red;
        padding: 10px;
    }
    .preview-upload img {
        width: 100px;
    }
</style>
@endsection
@section('content')
    <form action="{{ route('admin.movie.postadd') }}" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label>Tên Phim</label>
                <input type="text" name="title" class="form-control" placeholder="Nhập tên phim">


            </div>
            @error('title')
                <p style="color: red">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label>Danh Mục Phim</label>
                <select class="form-control" name="category_id">
                    @foreach ($category as $cate)
                        <option value="{{ $cate->id }}">{{ $cate->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Thể Loại</label>
                <select class="form-control" name="genre_id">
                    @foreach ($genre as $gen)
                        <option value="{{ $gen->id }}">{{ $gen->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Quốc Gia</label>
                <select class="form-control" name="country_id">
                    @foreach ($country as $coun)
                        <option value="{{ $coun->id }}">{{ $coun->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Mô Tả</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="status"
                        checked="">
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="status">
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

            <div class="form-group">
                <label for="image">Ảnh Bìa Phim</label>
                <input type="file" class="form-control" id="image" name="image" value="{{ old('image') }}">
                {{-- <img src="" id="image"> --}}
                <div class="preview-upload">
                    <img id='sp_hinh-upload' width="80px"/>
                </div>
            </div>

            <div class="">
                <button type="submit" class="btn btn-primary">Thêm Phim</button>
            </div>
            @csrf
    </form>
@endsection

@section('footer')
    <script>
        ClassicEditor.create(document.querySelector('#description')).catch(erro => {
            console.error(error);
        });
    </script>
    <script>
        // Sử dụng FileReader để đọc dữ liệu tạm trước khi upload lên Server
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#sp_hinh-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Bắt sự kiện, ngay khi thay đổi file thì đọc lại nội dung và hiển thị lại hình ảnh mới trên khung preview-upload
        $("#image").change(function(){
            readURL(this);
        });
    </script>
@endsection
