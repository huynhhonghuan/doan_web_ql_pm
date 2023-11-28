@extends('admin.main')
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
                <label>Danh Mục Phim</label>
                <select class="form-control" name="category_id">
                    @foreach ($category as $cate)
                        <option value="{{ $cate->id }}" {{ $movieEdit->category_id == $cate->id ? 'selected' : '' }}>
                            {{ $cate->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Thể Loại</label>
                <select class="form-control" name="genre_id">
                    @foreach ($genre as $gen)
                        <option value="{{ $gen->id }}" {{ $movieEdit->genre_id == $gen->id ? 'selected' : '' }}>
                            {{ $gen->title }}</option>
                    @endforeach
                </select>
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
                <label>Mô Tả</label>
                <textarea name="description" id="description" class="form-control">{{ $movieEdit->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="hinhanh">Ảnh Phim</label>
                <input type="file" class="form-control" id="image" name="image" value="" placeholder="">
                <div id="image_show">
                    <a href="{{ asset('image/movie') }}/{{ $movieEdit->image }}">
                        <img src="{{ asset('image/movie') }}/{{ $movieEdit->image }}" width="110" height="110">
                    </a>
                </div>
                <input type="hidden" name="thumb" id="thumb">
            </div>

            <div class="form-group">
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

            <div class="card-footer">
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
@endsection
