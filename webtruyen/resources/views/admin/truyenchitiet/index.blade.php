@extends('admin.layouts.main')
@section('content')
    <table class="table text-center">
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
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.truyenchitiet.edit', [$truyenchitiet]) }}"><i
                                    class="fas fa-edit"></i></a>
                            <form onclick="return confirm('Bạn có muốn xóa không?');" class="d-inline-block"
                                action="{{ route('admin.truyenchitiet.destroy', [$truyenchitiet]) }}" method="post">
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
