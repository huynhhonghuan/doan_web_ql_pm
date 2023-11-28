@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">STT</th>
            <th>Tiêu Đề</th>
            <th>Link</th>
            <th>Ảnh</th>
            <th>Trang Thái</th>
            <th>Cập Nhật</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sliders as $key => $slider)
            <tr>
                <td>{{ $key+1}}</td>
                <td>{{ $slider->name }}</td>
                <td>{{ $slider->url }}</td>
                <td><img src="{{asset('imageslider')}}/{{$slider->thumb}}" width="40"></td>
                @if ($slider->active==1)
                    <td><span class="btn btn-success btn-xs">Có</span></td>
                @else
                    <td><span class="btn btn-danger btn-xs">Không</span></td>
                @endif
                <td>{{ $slider->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.sliders.edit',['id'=>$slider->id]) }}"><i class="fas fa-edit"></i></a>
                    <a onclick="return confirm('Bạn chắc chắn muốn xóa?')" class="btn btn-danger btn-sm" href="{{ route('admin.sliders.delete',['id'=>$slider->id]) }}"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
