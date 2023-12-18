@extends('layout.main')
@section('content')
    <table class="table text-center">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Danh Mục</th>
                <th>Tên Danh Mục không dấu</th>
                <th>Mô Tả</th>
                <th>Trạng thái</th>
                <th>Thời gian cập nhật</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($categoryList))
            @foreach ($categoryList as $key=>$item)
            <tr>
                <td>{{ $key+1}}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->slug }}</td>
                <td>{!! $item->description !!}</td>
                @if ($item->status==1)
                    <td><span class="btn btn-success btn-xs">Có</span></td>
                @else
                    <td><span class="btn btn-danger btn-xs">Không</span></td>
                @endif
                {{-- <td>{{ $item->active }}</td>  --}}
                <td>{{ $item->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.category.edit',['id'=>$item->id]) }}"><i class="fas fa-edit"></i></a>
                    <a onclick="return confirm('Bạn chắc chắn muốn xóa?')" class="btn btn-danger btn-sm" href="{{ route('admin.category.delete',['id'=>$item->id]) }}"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="6">Không có danh mục nào</td>
            </tr>
            @endif
        </tbody>
    </table>
@endsection
