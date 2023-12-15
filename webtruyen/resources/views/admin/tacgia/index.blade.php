@extends('admin.layouts.main')
@section('content')
    <p class="pt-3">
        <a href="" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a>
        <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal"><i
                class="fa-light fa-upload"></i> Nhập từ Excel</a>
        <a href="" class="btn btn-success"><i class="fa-light fa-download"></i> Xuất
            ra Excel</a>
    </p>
    <table id="tabletruyen" class="table text-center">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Tác Giả</th>
                <th>Tên Tác Giả không dấu</th>
                <th>Mô Tả</th>
                <th>Trạng thái</th>
                <th>Thời gian cập nhật</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @if (empty($danhsach) == false)
                @foreach ($danhsach as $key => $tacgia)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $tacgia->tentacgia }}</td>
                        <td>{{ $tacgia->slug }}</td>
                        <td>{{ $tacgia->mota }}</td>
                        @if ($tacgia->khoa == 1)
                            <td><span class="btn btn-success btn-xs">Có</span></td>
                        @else
                            <td><span class="btn btn-danger btn-xs">Không</span></td>
                        @endif
                        <td>{{ $tacgia->updated_at }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.tacgia.edit', [$tacgia]) }}"><i
                                    class="fas fa-edit"></i></a>
                            <form onclick="return confirm('Bạn có muốn xóa không?');" class="d-inline-block"
                                action="{{ route('admin.tacgia.destroy', [$tacgia]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i> </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">Không có tác giả nào</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
