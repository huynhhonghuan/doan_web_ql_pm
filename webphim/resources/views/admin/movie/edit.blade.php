@extends('layout.main')
@section('head')
@endsection
@section('content')
    <form action="{{ route('admin.movie.postedit') }}" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label>Tên Phim</label>
                <input type="text" name="title" value="{{ $movieEdit->title }}" class="form-control"
                    placeholder="Nhập tên phim">
            </div>
            @error('title')
                <p style="color: red">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label>Thời Lượng Phim</label>
                <input type="text" name="time" value="{{ $movieEdit->time }}" class="form-control"
                    placeholder="VD: 133 phút hoặc 30 phút/tập">
            </div>

            <div class="form-group">
                <label>Link Trailer Phim</label>
                <input type="text" name="trailer" value="{{ $movieEdit->trailer }}" class="form-control"
                    placeholder="VD: https://www.youtube.com/watch?v=>>fO5t3tpVyuk<<">
            </div>

            <div class="form-group">
                <label>Danh Mục Phim</label>
                <select class="form-control" name="category_id" id="category_id">
                    @foreach ($category as $cate)
                        <option value="{{ $cate->id }}" {{ $movieEdit->category_id == $cate->id ? 'selected' : '' }}>
                            {{ $cate->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" id="form-ep">
                <label>Số Tập Phim</label>
                <input type="number" min="0" max="2000" value="{{ $movieEdit->episodes }}" name="episodes" class="form-control" placeholder="">
            </div>

            <div class="form-group">
                <label>Thể Loại</label>
                <br>
                {{-- <select class="form-control" name="genre_id">
                    @foreach ($genre as $gen)
                        <option value="{{ $gen->id }}" {{ $movieEdit->genre_id == $gen->id ? 'selected' : '' }}>
                            {{ $gen->title }}</option>
                    @endforeach
                </select> --}}
                @foreach ($genre as $key => $gen)
                    <input type="checkbox" name="genre[]" id="" value="{{ $gen->id }}" {{ isset($movie_genre) && $movie_genre->contains($gen->id) ? 'checked':'' }}>
                    <label for="genre" style="margin-right: 10px;">{{ $gen->title }}</label>
                @endforeach
            </div>

            <div class="form-group">
                <label>Quốc Gia</label>
                <select class="form-control" name="country_id">
                    @foreach ($country as $coun)
                        <option value="{{ $coun->id }}" {{ $movieEdit->country_id == $coun->id ? 'selected' : '' }}>
                            {{ $coun->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Định dạng</label>
                <select class="form-control" name="resolution">
                    <option value="0" {{ $movieEdit->resolution == 0 ? 'selected' : '' }}>SD</option>
                    <option value="1" {{ $movieEdit->resolution == 1 ? 'selected' : '' }}>HD</option>
                    <option value="2" {{ $movieEdit->resolution == 2 ? 'selected' : '' }}>Trailer</option>
                </select>
            </div>

            <div class="form-group">
                <label>Phụ Đề</label>
                <select class="form-control" name="subtitle">
                    <option value="0" {{ $movieEdit->subtitle == 0 ? 'selected' : '' }}>Thuyết minh</option>
                    <option value="1" {{ $movieEdit->subtitle == 1 ? 'selected' : '' }}>Phụ đề</option>
                </select>
            </div>

            <div class="form-group">
                <label>Mô Tả</label>
                <textarea name="description" id="description" class="form-control">{{ $movieEdit->description }}</textarea>
            </div>

            <div class="form-group">
                <label>Tags Phim</label>
                <textarea name="tags" id="tags" class="form-control">{{ $movieEdit->tags }}</textarea>
            </div>

            <div class="form-group">
                <label for="hinhanh">Ảnh Phim</label>
                <input type="file" class="form-control" id="image" name="image" value="" placeholder="">
                <div id="preview-upload">
                    <a href="{{ asset('image/movie') }}/{{ $movieEdit->image }}">
                        <img id='sp_hinh-upload' src="{{ asset('image/movie') }}/{{ $movieEdit->image }}" width="100">
                    </a>
                </div>
                <input type="hidden" name="thumb" id="thumb">
            </div>

            <div class="form-group d-flex flex-wrap">
                <div style="padding-right: 20%">
                    <label>Kích Hoạt</label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="1" type="radio" id="active" name="status"
                            {{ $movieEdit->status == 1 ? 'checked=""' : '' }}>
                        <label for="active" class="custom-control-label">Có</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="0" type="radio" id="no_active" name="status"
                            {{ $movieEdit->status == 0 ? 'checked=""' : '' }}>
                        <label for="no_active" class="custom-control-label">Không</label>
                    </div>
                </div>

                <div style="padding-right: 20%">
                    <label>Phim Hot</label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="1" type="radio" id="active1" name="movie_hot"
                            {{ $movieEdit->movie_hot == 1 ? 'checked=""' : '' }}>
                        <label for="active1" class="custom-control-label">Có</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="0" type="radio" id="no_active1"
                            name="movie_hot" {{ $movieEdit->movie_hot == 0 ? 'checked=""' : '' }}>
                        <label for="no_active1" class="custom-control-label">Không</label>
                    </div>
                </div>

                {{-- <div style="padding-right: 20%">
                    <label>Định dạng</label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="1" type="radio" id="active2" name="resolution"
                            {{ $movieEdit->resolution == 1 ? 'checked=""' : '' }}>
                        <label for="active2" class="custom-control-label">SD</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="0" type="radio" id="no_active2" name="resolution"
                            {{ $movieEdit->resolution == 0 ? 'checked=""' : '' }}>
                        <label for="no_active2" class="custom-control-label">HD</label>
                    </div>
                </div> --}}

                {{-- <div>
                    <label>Phụ đề</label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="1" type="radio" id="active3" name="subtitle"
                            {{ $movieEdit->subtitle == 1 ? 'checked=""' : '' }}>
                        <label for="active3" class="custom-control-label">Phụ đề</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="0" type="radio" id="no_active3" name="subtitle"
                            {{ $movieEdit->subtitle == 0 ? 'checked=""' : '' }}>
                        <label for="no_active3" class="custom-control-label">Thuyết minh</label>
                    </div>
                </div> --}}
            </div>



            <div class="">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
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
