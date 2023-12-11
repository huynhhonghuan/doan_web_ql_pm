@extends('admin.layouts.main')
@section('content')
    <table class="table text-center">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Thể Loại</th>
                <th>Tên Thể Loại không dấu</th>
                <th>Mô Tả</th>
                <th>Trạng thái</th>
                <th>Thời gian cập nhật</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @if (empty($danhsach) == false)
                @foreach ($danhsach as $key => $theloai)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $theloai->tentheloai }}</td>
                        <td>{{ $theloai->slug }}</td>
                        <td>{{ $theloai->mota }}</td>
                        @if ($theloai->khoa == 1)
                            <td><span class="btn btn-success btn-xs">Có</span></td>
                        @else
                            <td><span class="btn btn-danger btn-xs">Không</span></td>
                        @endif
                        <td>{{ $theloai->updated_at }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.theloai.edit', [$theloai]) }}"><i
                                    class="fas fa-edit"></i></a>
                            <form onclick="return confirm('Bạn có muốn xóa không?');" class="d-inline-block"
                                action="{{ route('admin.theloai.destroy', [$theloai]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i> </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">Không có thể loại nào</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
