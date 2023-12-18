@extends('layout.main')
@section('content')
    <table class="table text-center" id="tablephim">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Phim</th>
                <th>Danh Mục</th>
                <th>Thể Loại</th>
                <th>Quốc Gia</th>
                <th>Định Dạng</th>
                <th>Phụ Đề</th>
                <th>Thời lượng</th>
                <th scope="col">Mô Tả</th>
                <th scope="col">Tags</th>
                <th>Trạng Thái</th>
                <th>Phim Hot</th>
                <th>Số tập</th>
                <th>Năm Phim</th>
                <th>Ảnh Bìa</th>
                {{-- <th>Thời gian cập nhật</th> --}}
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($movieList))
                @foreach ($movieList as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->Category->title }}</td>
                        <td>
                            @foreach ($item->movie_genre as $gen)
                                <span class="badge badge-dark"> {{ $gen->title }}</span>
                            @endforeach
                        </td>
                        <td>{{ $item->Country->title }}</td>
                        @if ($item->resolution == 0)
                            <td><span>SD</span></td>
                        @elseif($item->resolution == 1)
                            <td><span>HD</span></td>
                        @elseif($item->resolution == 2)
                            <td><span>Trailer</span></td>
                        @endif
                        @if ($item->subtitle == 1)
                            <td><span>Phụ đề</span></td>
                        @else
                            <td><span>Thuyết minh</span></td>
                        @endif
                        <td>{{ $item->time }}</td>
                        <td>{!! $item->description !!}</td>
                        <td>{!! $item->tags !!}</td>
                        @if ($item->status == 1)
                            <td><span class="btn btn-success btn-xs">Hiển thị</span></td>
                        @else
                            <td><span class="btn btn-danger btn-xs">Không hiện thị</span></td>
                        @endif
                        @if ($item->movie_hot == 1)
                            <td><span class="btn btn-success btn-xs">Có</span></td>
                        @else
                            <td><span class="btn btn-danger btn-xs">Không</span></td>
                        @endif
                        <td>
                            @if ($item->episodes == 0)
                                ?? tập
                            @else
                                {{ $item->episodes }} tập
                            @endif
                        </td>
                        <td>
                            <select name="year" id="{{ $item->id }}" class="select-year">
                                <script>
                                    var today = new Date();
                                    var nam = today.getFullYear();
                                    for (var i = 2000; i <= nam; i++) {
                                        document.write("<option value='" + i + "'>" + i + "</option>");
                                    }
                                </script>
                            </select>
                        </td>
                        <script>
                            for (var j = 0; j < document.getElementById({{ $item->id }}).options.length; j++) {
                                if (document.getElementById({{ $item->id }}).options[j].value == {{ $item->year }})
                                    document.getElementById({{ $item->id }}).options[j].selected = true;
                            }
                        </script>
                        <td><img src="{{ asset('image/movie') }}/{{ $item->image }}" width="80" height="100"></td>
                        {{-- <td>{{ $item->updated_at }}</td> --}}
                        <td>
                            <a class="btn btn-primary btn-sm"
                                href="{{ route('collaborators.movie.edit', ['id' => $item->id]) }}"><i class="fas fa-edit"></i></a>
                            <a onclick="return confirm('Bạn chắc chắn muốn xóa?')" class="btn btn-danger btn-sm"
                                href="{{ route('collaborators.movie.delete', ['id' => $item->id]) }}"><i
                                    class="fas fa-trash"></i></a>
                            <a class="btn btn-success btn-sm"
                                href="{{ route('collaborators.episode.add', ['id' => $item->id]) }}"><i class="fa fa-plus"></i></a>
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
