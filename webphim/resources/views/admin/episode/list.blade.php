@extends('layout.main')
@section('content')
    <table class="table text-center" id="tablephim">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên Phim</th>
                <th>Thông Tin</th>
                <th>Ảnh Bìa Phim</th>
                {{-- <th>Thời gian cập nhật</th> --}}
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($movie))
                @foreach ($movie as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->title }}</td>
                        <td>
                            <table class="table table-bordered table-hover table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th width="15%">Tập</th>
                                        <th width="20%">Link Phim</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->episode as $key => $ep)
                                        <tr>
                                            <td>{{ $ep->episode }}</td>
                                            <td>{{ $ep->linkphim }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                        <td><img src="{{ asset('image/movie') }}/{{ $item->image }}" width="80" height="100"></td>
                        {{-- <td>{{ $item->updated_at }}</td> --}}
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.episode.edit', ['id' => $item->id]) }}"><i
                                    class="fas fa-edit"></i></a>
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
