@extends('layout.main')
@section('head')
    <style>
        .preview-upload img {
            width: 110px;
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
                <label>Thời Lượng Phim</label>
                <input type="text" name="time" class="form-control" placeholder="VD: 133 phút hoặc 30 phút/tập">
            </div>

            <div class="form-group">
                <label>Link Trailer Phim</label>
                <input type="text" name="trailer" class="form-control"
                    placeholder="VD: https://www.youtube.com/watch?v=>fO5t3tpVyuk<">
            </div>

            <div class="form-group">
                <label>Danh Mục Phim</label>
                <select class="form-control" name="category_id" id="category_id">
                    @foreach ($category as $cate)
                        <option value="{{ $cate->id }}">{{ $cate->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" id="form-ep">
                <label>Số Tập Phim</label>
                <input type="number" min="0" max="2000" name="episodes" class="form-control" placeholder="">
            </div>

            <div class="form-group">
                <label>Thể Loại</label>
                <br>
                {{-- <select class="form-control" name="genre_id">
                    @foreach ($genre as $gen)
                        <option value="{{ $gen->id }}">{{ $gen->title }}</option>
                    @endforeach
                </select> --}}
                @foreach ($genre as $key => $gen)
                    <input type="checkbox" name="genre[]" id="" value="{{ $gen->id }}">
                    <label for="genre" style="margin-right: 10px;">{{ $gen->title }}</label>
                @endforeach
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
                <label>Tags Phim</label>
                <textarea name="tags" id="tags" class="form-control"></textarea>
            </div>


            <div class="form-group d-flex flex-wrap">
                <div style="padding-right: 20%">
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

                <div style="padding-right: 20%">
                    <label>Phim Hot</label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="1" type="radio" id="active1" name="movie_hot"
                            checked="">
                        <label for="active1" class="custom-control-label">Có</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="0" type="radio" id="no_active1" name="movie_hot">
                        <label for="no_active1" class="custom-control-label">Không</label>
                    </div>
                </div>

                {{-- <div class="" style="padding-right: 20%">
                    <label>Định dạng</label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="1" type="radio" id="active2" name="resolution"
                            checked="">
                        <label for="active2" class="custom-control-label">SD</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="0" type="radio" id="no_active2" name="resolution">
                        <label for="no_active2" class="custom-control-label">HD</label>
                    </div>
                </div> --}}

                <div>
                    <label>Phụ đề</label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="1" type="radio" id="active3" name="subtitle"
                            checked="">
                        <label for="active3" class="custom-control-label">Phụ đề</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="0" type="radio" id="no_active3"
                            name="subtitle">
                        <label for="no_active3" class="custom-control-label">Thuyết minh</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label>Định Dạng</label>
                    <select class="form-control" name="resolution">
                        <option value="0">SD</option>
                        <option value="1">HD</option>
                        <option value="2">Trailer</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="image">Ảnh Bìa Phim</label>
                <input type="file" class="form-control" id="image" name="image" value="{{ old('image') }}">
                {{-- <img src="" id="image"> --}}
                <div class="preview-upload">
                    <img id='sp_hinh-upload' width="80px" />
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
                reader.onload = function(e) {
                    $('#sp_hinh-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Bắt sự kiện, ngay khi thay đổi file thì đọc lại nội dung và hiển thị lại hình ảnh mới trên khung preview-upload
        $("#image").change(function() {
            readURL(this);
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#form-ep").hide();
            $("#category_id").change(function() {
                var selectedValue = $(this).val();
                console.log(selectedValue);
                if (selectedValue === '1') {
                    $("#form-ep").hide();
                    $("#form-ep input").removeAttr("required");
                } else {
                    $("#form-ep").show();
                    $("#form-ep input").attr("required", "required");
                }
            });
        });
    </script>
@endsection
