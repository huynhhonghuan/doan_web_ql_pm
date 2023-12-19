@extends('congtacvientruyen.layouts.main')
@section('head')
@endsection
@section('content')
    <form action="{{ route('ctvt.truyenchitiet.update', [$truyenchitiet]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="card-body">
            <div class="form-group" data-select2-id="29">
                <label>Tên truyện</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1"
                    tabindex="-1" aria-hidden="true" name="truyen_id">
                    <option data-select2-id="3" value="">Chọn tên truyện</option>
                    @foreach ($truyen as $value)
                        @if ($truyenchitiet->truyen_id == $value->id)
                            <option selected="selected" value="{{ $value->id }}">{{ $value->tentruyen }}</option>
                        @else
                            <option value="{{ $value->id }}">{{ $value->tentruyen }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="formFileLg" class="form-label">Hình ảnh</label>
                <input class="form-control form-control-lg" id="formFileLg" name="hinhanh" type="file">
            </div>

            <div class="form-group col-sm-3">
                <label>Số chương</label>
                <input type="number" name="chuong" class="form-control" placeholder="Số chương"
                    value="{{ $truyenchitiet->chuong }}">
            </div>
            @error('chuong')
                <p style="color: red">{{ $message }}</p>
            @enderror

            <div class="">
                <button type="submit" class="btn btn-primary">Tạo chi tiết truyện</button>
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
