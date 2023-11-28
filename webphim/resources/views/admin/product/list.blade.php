@extends('admin.main')
@section('content')
    <table class="table text-center">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Sản Phẩm</th>
                <th>Danh Mục</th>
                <th>Giá Gốc</th>
                <th>Giá Khuyến Mãi</th>
                <th>Trạng thái</th>
                <th>Thời gian cập nhật</th>
                <th>Hình ảnh</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($proList))
            @foreach ($proList as $key=>$item)
            <tr>
                <td>{{ $key+1}}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->Menu->name }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->price_sale }}</td>
                @if ($item->active==1)
                    <td><span class="btn btn-success btn-xs">Có</span></td>
                @else
                    <td><span class="btn btn-danger btn-xs">Không</span></td>
                @endif
                <td>{{ $item->updated_at }}</td>
                <td><img src="{{asset('image')}}/{{$item->thumb}}" width="60"></td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.products.edit',['id'=>$item->id]) }}"><i class="fas fa-edit"></i></a>
                    <a onclick="return confirm('Bạn chắc chắn muốn xóa?')" class="btn btn-danger btn-sm" href="{{ route('admin.products.delete',['id'=>$item->id]) }}"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="6">Không có Sản Phẩm nào</td>
            </tr>
            @endif
        </tbody>
    </table>
@endsection
