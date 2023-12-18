@extends('layout.main')
@section('head')
@endsection
@section('content')
    <form action="{{ route('admin.episode.postedit') }}" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label>Tên Phim</label>
                <input type="text" name="title" value="{{ $episodeEdit->title }}" readonly class="form-control">
            </div>
            @error('title')
                <p style="color: red">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <table class="table table-bordered table-hover table-sm mb-0">
                    <thead>
                        <tr>
                            <th width="0%">Tập</th>
                            <th width="20%">Link Phim</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($episodeEdit->episode as $key => $ep)
                            <tr>
                                <td style="width: 10%;">
                                    <p class=""> {{ $ep->episode }}</p>
                                </td>
                                <td>
                                    <textarea name="linkphim{{$key}}" id="linkphim" class="form-control">{{ $ep->linkphim }}</textarea></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
            @csrf
    </form>
@endsection
@section('footer')
@endsection
