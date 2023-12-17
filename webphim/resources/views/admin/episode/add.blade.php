@extends('admin.main')
@section('head')
    <style>
        .preview-upload img {
            width: 110px;
        }
    </style>
@endsection
@section('content')
    <form action="{{ route('admin.episode.postadd') }}" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label>Link Phim</label>
                <input type="text" name="linkphim" class="form-control" placeholder="...">
            </div>

            <div class="form-group">
                <label>Tập Phim</label>
                <select class="form-control" name="episode">
                    <option value="0" style="display: none;">---Chọn tập phim---</option>
                    @if ($movie->episode == $movie->episode_now)
                        @for ($i = 1; $i <= $movie->episode; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    @else
                        @for ($i = 1; $i <= $movie->episode_now; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    @endif
                </select>
            </div>

            <div class="">
                <button type="submit" class="btn btn-primary">Thêm Tập Phim</button>
            </div>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    {{-- <script>
        ClassicEditor.create(document.querySelector('#description')).catch(erro => {
            console.error(error);
        });
    </script>
    <script>
        // Sử dụng FileReader để đọc dữ liệu tạm trước khi upload lên Server
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#sp_hinh-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Bắt sự kiện, ngay khi thay đổi file thì đọc lại nội dung và hiển thị lại hình ảnh mới trên khung preview-upload
        $("#image").change(function() {
            readURL(this);
        });
    </script> --}}
@endsection
