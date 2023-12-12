@extends('admin.layouts.main')
@section('head')
@endsection
@section('content')
    <form action="{{ route('admin.truyen.update', [$truyen]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="card-body">
            <div class="form-group">
                <label>Tên truyện</label>
                <input type="text" name="tentruyen" value="{{ $truyen->tentruyen }}" class="form-control"
                    placeholder="Nhập tên truyện">
            </div>
            @error('tentruyen')
                <p style="color: red">{{ $message }}</p>
            @enderror

            <div class="form-group" data-select2-id="29">
                <label>Tên tác giả</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1"
                    tabindex="-1" aria-hidden="true" name="tacgia_id">
                    <option data-select2-id="3" value="">Chọn tên tác giả</option>
                    @foreach ($tacgia as $value)
                        @if ($value->id == $truyen->tacgia_id)
                            <option selected="selected" value="{{ $value->id }}">{{ $value->tentacgia }}</option>
                        @else
                            <option value="{{ $value->id }}">{{ $value->tentacgia }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group" data-select2-id="29">
                <label>Tên thể loại</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1"
                    tabindex="-1" aria-hidden="true" name="theloai_id">
                    <option data-select2-id="3" value="">Chọn tên tác giả</option>
                    @foreach ($theloai as $value)
                        @if ($value->id == $truyen->theloai_id)
                            <option selected="selected" value="{{ $value->id }}">{{ $value->tentheloai }}</option>
                        @else
                            <option value="{{ $value->id }}">{{ $value->tentheloai }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group" data-select2-id="29">
                <label>Tên quốc gia</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1"
                    tabindex="-1" aria-hidden="true" name="quocgia_id">
                    <option data-select2-id="3" value="">Chọn tên tác giả</option>
                    @foreach ($quocgia as $value)
                        @if ($value->id == $truyen->quocgia_id)
                            <option selected="selected" value="{{ $value->id }}">{{ $value->tenquocgia }}</option>
                        @else
                            <option value="{{ $value->id }}">{{ $value->tenquocgia }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="formFileLg" class="form-label">Hình ảnh</label>
                <input class="form-control form-control-lg" id="formFileLg" name="hinhanh" type="file"
                    value="{{ old('hinhanh') }}">
            </div>

            <div class="form-group">
                <label>Mô Tả</label>
                <textarea name="mota" id="mota" class="form-control">{{ $truyen->mota }}</textarea>
            </div>

            <div class="form-group">
                <label>Tên nhóm dịch</label>
                <input type="text" name="nhomdich" class="form-control" placeholder="Nhập tên nhóm dịch"
                    value="{{ $truyen->nhomdich }}">
            </div>
            @error('nhomdich')
                <p style="color: red">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label>Kích Hoạt</label>
                @if ($truyen->khoa == 1)
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="1" type="radio" id="active" name="khoa"
                            checked>
                        <label for="active" class="custom-control-label">Có</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="0" type="radio" id="no_active" name="khoa">
                        <label for="no_active" class="custom-control-label">Không</label>
                    </div>
                @else
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="1" type="radio" id="active" name="khoa">
                        <label for="active" class="custom-control-label">Có</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="0" type="radio" id="no_active" name="khoa"
                            checked>
                        <label for="no_active" class="custom-control-label">Không</label>
                    </div>
                @endif
            </div>

            <div class="">
                <button type="submit" class="btn btn-primary">Lưu truyện</button>
            </div>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        ClassicEditor.create(document.querySelector('#mota')).catch(erro => {
            console.error(error);
        });
    </script>
@endsection
