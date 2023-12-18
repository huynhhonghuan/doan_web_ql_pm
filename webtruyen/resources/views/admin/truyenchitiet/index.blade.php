@extends('admin.layouts.main')
@section('content')
<p class="mt-3">
    <a href="{{route('admin.truyenchitiet.create')}}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a>
    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default">
        Nhập từ Excel
    </button>
    <a href="{{ route('admin.truyenchitiet.xuat') }}" class="btn btn-success"><i class="fa-light fa-download"></i> Xuất
        ra Excel</a>
    <a href="{{ route('admin.truyenchitiet.hinh') }}" class="btn btn-danger"><i class="fa-light fa-download"></i> Xuất
        ra hình ảnh</a>
</p>
<table id="tabletruyen" class="table text-center">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên Truyện</th>
            <th>Hình ảnh</th>
            <th>Chương</th>
            <th>Thời gian cập nhật</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @if (empty($danhsach) == false)
        @foreach ($danhsach as $key => $truyenchitiet)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $truyenchitiet->Truyen->tentruyen }}</td>
            <td>{{ $truyenchitiet->hinhanh }}</td>
            <td>{{ $truyenchitiet->chuong }}</td>
            <td>{{ $truyenchitiet->updated_at }}</td>
            <td>
                <a class="btn btn-primary btn-sm" href="{{ route('admin.truyenchitiet.edit', [$truyenchitiet]) }}"><i class="fas fa-edit"></i></a>
                <form onclick="return confirm('Bạn có muốn xóa không?');" class="d-inline-block" action="{{ route('admin.truyenchitiet.destroy', [$truyenchitiet]) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i> </button>
                </form>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="6">Không có Truyện nào</td>
        </tr>
        @endif
    </tbody>
</table>

<form action="{{ route('admin.truyenchitiet.nhap') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="modal-default" style="display: none;" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Nhập từ Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-0">
                        <label for="file_excel" class="form-label">Chọn tập tin Excel</label>
                        <input type="file" class="form-control" id="file_excel" name="file_excel" required />
                    </div>
                </div>
                <div class="modal-body">
                    <div class="mb-0">
                        <label for="hinhanh" class="form-label">Chọn các hình ảnh</label>
                        <input type="file" class="form-control" id="hinhanh" name="hinhanh[]" required multiple />
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
                    <button type="submit" class="btn btn-primary">Nhập dữ liệu</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection