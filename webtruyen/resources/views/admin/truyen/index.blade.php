@extends('admin.layouts.main')
@section('content')
    <p class="mt-3">
        <a href="{{ route('admin.truyen.create') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a>
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default">
            Nhập từ Excel
        </button>
        <a href="{{ route('admin.truyen.xuat') }}" class="btn btn-success"><i class="fa-light fa-download"></i> Xuất
            ra Excel</a>
    </p>
    <table id="tabletruyen" class="table text-center p-1">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Truyện</th>
                <th>Tên Truyện không dấu</th>
                <th>Hình ảnh</th>
                <th>Nhóm dịch </th>
                <th>Tên tác giả</th>
                <th>Tên thể loại</th>
                <th>Tên quốc gia</th>
                <th>Mô Tả</th>
                <th>Trạng thái</th>
                <th>Thời gian cập nhật</th>
                <th>Chỉnh sửa</th>
            </tr>
        </thead>
        <tbody>
            @if (empty($danhsach) == false)
                @foreach ($danhsach as $key => $truyen)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $truyen->tentruyen }}</td>
                        <td>{{ $truyen->slug }}</td>
                        <td>{{ $truyen->hinhanh }}</td>
                        <td>{{ $truyen->nhomdich }}</td>
                        <td>{{ $truyen->TacGia->tentacgia }}</td>
                        <td>{{ $truyen->TheLoai->tentheloai }}</td>
                        <td>{{ $truyen->QuocGia->tenquocgia }}</td>
                        <td>{{ $truyen->mota }}</td>
                        @if ($truyen->khoa == 1)
                            <td><span class="btn btn-success btn-xs">Có</span></td>
                        @else
                            <td><span class="btn btn-danger btn-xs">Không</span></td>
                        @endif
                        <td>{{ $truyen->updated_at }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.truyen.edit', [$truyen]) }}"><i
                                    class="fas fa-edit"></i></a>
                            <form onclick="return confirm('Bạn có muốn xóa không?');" class="d-inline-block"
                                action="{{ route('admin.truyen.destroy', [$truyen]) }}" method="post">
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

    <form action="{{ route('admin.truyen.nhap') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="modal-default" style="display: none;" tabindex="-1" role="dialog"
            aria-labelledby="importModalLabel" aria-hidden="true">
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
                            <input type="file" class="form-control" id="hinhanh" name="hinhanh[]" required multiple/>
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
