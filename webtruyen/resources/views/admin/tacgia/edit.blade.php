@extends('admin.layouts.main')
@section('head')
@endsection
@section('content')
    <form action="{{ route('admin.tacgia.update', [$tacgia]) }}" method="post">
        @csrf
        @method('put')

        <div class="card-body">
            <div class="form-group">
                <label>Tên Tác GIả</label>
                <input type="text" name="tentacgia" value="{{ $tacgia->tentacgia}}" class="form-control"
                    placeholder="Nhập tên tác giả">
            </div>
            @error('tentacgia')
                <p style="color: red">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label>Mô Tả</label>
                <textarea name="mota" id="mota" class="form-control">{{ $tacgia->mota }}</textarea>
            </div>

            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="khoa"
                        {{ $tacgia->khoa == 1 ? 'checked=""' : '' }}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="khoa"
                        {{ $tacgia->khoa == 0 ? 'checked=""' : '' }}>
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
        ClassicEditor.create(document.querySelector('#mota')).catch(erro => {
            console.error(error);
        });
    </script>
@endsection
