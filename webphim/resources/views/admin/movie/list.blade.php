@extends('admin.main')
@section('content')
    <table class="table text-center" id="tablephim">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Phim</th>
                <th>Danh Mục</th>
                <th>Thể Loại</th>
                <th>Quốc Gia</th>
                <th scope="col">Mô Tả</th>
                <th>Trạng thái</th>
                <th>Hình Ảnh</th>
                <th>Thời gian cập nhật</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($movieList))
                @foreach ($movieList as $key=>$item)
                <tr>
                    <td>{{ $key+1}}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->Category->title }}</td>
                    <td>{{ $item->Genre->title }}</td>
                    <td>{{ $item->Country->title }}</td>
                    <td>{{ $item->description }}</td>
                    @if ($item->status==1)
                        <td><span class="btn btn-success btn-xs">Có</span></td>
                    @else
                        <td><span class="btn btn-danger btn-xs">Không</span></td>
                    @endif
                    <td><img src="{{asset('image/movie')}}/{{$item->image}}" width="80"></td>
                    <td>{{ $item->updated_at }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.movie.edit',['id'=>$item->id]) }}"><i class="fas fa-edit"></i></a>
                        <a onclick="return confirm('Bạn chắc chắn muốn xóa?')" class="btn btn-danger btn-sm" href="{{ route('admin.movie.delete',['id'=>$item->id]) }}"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            @else
            <tr>
                <td colspan="6">Không có phim nào</td>
            </tr>
            @endif
        </tbody>
    </table>
@endsection

