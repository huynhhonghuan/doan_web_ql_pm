@extends('admin.layouts.main')
@section('content')
    <p class="pt-3">
        <a href="{{ route('admin.taikhoan.create') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a>
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default">
            Nhập từ Excel
        </button>
        <a href="#" class="btn btn-success"><i class="fa-light fa-download"></i> Xuất
            ra Excel</a>
    </p>
    <table id="tabletruyen" class="table text-center">
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ và tên</th>
                <th>Username</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Vai trò</th>
                <th>Trạng thái</th>
                <th>Thời gian cập nhật</th>
                <th>Chỉnh sửa</th>
            </tr>
        </thead>
        <tbody>
            @if (empty($danhsach) == false)
                @foreach ($danhsach as $key => $taikhoan)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $taikhoan->name }}</td>
                        <td>{{ $taikhoan->username }}</td>
                        <td>{{ $taikhoan->email }}</td>
                        <td>{{ $taikhoan->sdt }}</td>
                        <td>{{ $taikhoan->getVaiTro[0]->tenvaitro }}</td>
                        @if ($taikhoan->status == 'active')
                            <td><span class="btn btn-success btn-xs">Hoạt động</span></td>
                        @else
                            <td><span class="btn btn-danger btn-xs">Không hoạt động</span></td>
                        @endif
                        <td>{{ $taikhoan->updated_at }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.taikhoan.edit', [$taikhoan]) }}"><i
                                    class="fas fa-edit"></i></a>
                            <form onclick="return confirm('Bạn có muốn xóa không?');" class="d-inline-block"
                                action="{{ route('admin.taikhoan.destroy', [$taikhoan]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i> </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">Không có quốc gia nào</td>
                </tr>
            @endif
        </tbody>
    </table>

    <form action="#" method="post" enctype="multipart/form-data">
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
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy bỏ</button>
                        <button type="submit" class="btn btn-primary">Nhập dữ liệu</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
