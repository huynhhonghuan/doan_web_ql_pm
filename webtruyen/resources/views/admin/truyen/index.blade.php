@extends('admin.layouts.main')
@section('content')
    <table class="table text-center">
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
                <th>&nbsp;</th>
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
                        <td>{{ $truyen->TacGia->tentacgia}}</td>
                        <td>{{ $truyen->TheLoai->tentheloai}}</td>
                        <td>{{ $truyen->QuocGia->tenquocgia}}</td>
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
@endsection
