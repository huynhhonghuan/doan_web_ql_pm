@extends('congtacvientruyen.layouts.main')
@section('head')
@endsection
@section('content')
    <form action="{{ route('ctv.truyen.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Tên truyện</label>
                <input type="text" name="tentruyen" class="form-control" placeholder="Nhập tên truyện">
            </div>
            @error('tentruyen')
                <p style="color: red">{{ $message }}</p>
            @enderror

            <div class="form-group" data-select2-id="29">
                <label>Tên tác giả</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1"
                    tabindex="-1" aria-hidden="true" name="tacgia_id">
                    <option selected="selected" data-select2-id="3" value="">Chọn tên tác giả</option>
                    @foreach ($tacgia as $value)
                        <option value="{{ $value->id }}">{{ $value->tentacgia }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" data-select2-id="29">
                <label>Tên thể loại</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1"
                    tabindex="-1" aria-hidden="true" name="theloai_id">
                    <option selected="selected" data-select2-id="3" value="">Chọn tên thể loại</option>
                    @foreach ($theloai as $value)
                        <option value="{{ $value->id }}">{{ $value->tentheloai }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" data-select2-id="29">
                <label>Tên quốc gia</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1"
                    tabindex="-1" aria-hidden="true" name="quocgia_id">
                    <option selected="selected" data-select2-id="3" value="">Chọn tên quốc gia</option>
                    @foreach ($quocgia as $value)
                        <option value="{{ $value->id }}">{{ $value->tenquocgia }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="formFileLg" class="form-label">Hình ảnh</label>
                <input class="form-control form-control-lg" id="formFileLg" name="hinhanh" type="file">
            </div>

            <div class="form-group">
                <label>Mô Tả</label>
                <textarea name="mota" id="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label>Tên nhóm dịch</label>
                <input type="text" name="nhomdich" class="form-control" placeholder="Nhập tên nhóm dịch">
            </div>
            @error('nhomdich')
                <p style="color: red">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="khoa"
                        checked="">
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="khoa">
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

            <div class="">
                <button type="submit" class="btn btn-primary">Tạo truyện</button>
            </div>
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
