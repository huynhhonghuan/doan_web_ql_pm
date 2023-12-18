@extends('layout.main')
@section('head')

@endsection
@section('content')
<form action="{{ route('admin.category.postedit') }}" method="post">
    <div class="card-body">
      <div class="form-group">
        <label>Tên Danh Mục</label>
        <input type="text" name="title" value="{{ $categoryEdit->title }}" class="form-control"  placeholder="Nhập tên danh mục">
      </div>
      @error('title')
        <p style="color: red">{{ $message }}</p>
      @enderror

      <div class="form-group">
        <label>Mô Tả</label>
        <textarea name="description" id="description" class="form-control">{{ $categoryEdit->description }}</textarea>
      </div>


        <div class="form-group">
            <label>Kích Hoạt</label>
            <div class="custom-control custom-radio">
              <input class="custom-control-input" value="1" type="radio" id="active" name="status" {{ $categoryEdit->status == 1 ? 'checked=""' : ''}}>
              <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
              <input class="custom-control-input" value="0" type="radio" id="no_active" name="status" {{ $categoryEdit->status == 0 ? 'checked=""' : ''}}>
              <label for="no_active" class="custom-control-label">Không</label>
            </div>
          </div>

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Cập nhật Danh Mục</button>
    </div>
    @csrf
  </form>
@endsection

@section('footer')
  <script>
      ClassicEditor.create(document.querySelector('#description')).catch(erro =>{
        console.error(error);
      });
  </script>
@endsection
