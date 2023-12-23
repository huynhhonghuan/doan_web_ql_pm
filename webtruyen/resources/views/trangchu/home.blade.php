@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('owl-carousel/css/owl.theme.default.min.css') }}">
@endsection
@extends('trangchu.layout')
@section('content')
    <div class="py-5">
        <div class="owl-carousel owl-theme">
            @foreach ($truyen as $item)
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('image/truyen/' . $item->slug . '/' . $item->hinhanh) }}" class="card-img-top"
                        alt="..." style="width: 250px; height: 200px;">
                    <h4>{{ $item->tentruyen }}</h3>
                </div>
            @endforeach
        </div>
    </div>
    <div class="container overflow-hidden">
        <h3 class="text-white">Mới cập nhật</h3>
        <div class="row">
            <div class="col-md-7 me-5">
                <div class="row">
                    @foreach ($truyenmoinhat as $item)
                        <div class="col-md-6 my-5 pb-5 border-bottom border-secondary">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ asset('image/truyen/' . $item->slug . '/' . $item->hinhanh) }}"
                                        class="card-img-top" alt="..." style="width: 120px; height: 150px;">
                                </div>
                                <div class="col-md-8">
                                    <a href="{{ route('truyen', ['id' => $item->id]) }}"
                                        class="text-decoration-none text-white fs-3">
                                        {{ $item->tentruyen }}
                                    </a>
                                    <h4 class="text-white mt-3">Tác giả: {{ $item->TacGia->tentacgia }}</h4>
                                    <!-- truyen reviews-->
                                    <div class="d-flex justify-content-start small text-warning my-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                        <div class="bi-star"></div>
                                    </div>
                                    <h5 class="mb-auto">{{ $item->updated_at }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4 border border-secondary rounded-2 ms-2">
                <h3 class="text-danger">Đọc nhiều trong ngày</h3>
                @foreach ($truyenmoinhat as $item)
                    <div class="col-12 my-5 pb-5 border-bottom border-secondary">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('image/truyen/' . $item->slug . '/' . $item->hinhanh) }}"
                                    class="card-img-top" alt="..." style="width: 100px; height: 130px;">
                            </div>
                            <div class="col-md-8">
                                <a href="#" class="text-decoration-none text-white fs-3">
                                    {{ $item->tentruyen }}
                                </a>
                                <h4 class="text-white mt-3">Tác giả: {{ $item->TacGia->tentacgia }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container my-5">
        <h3 class="text-white">Review mới nhất</h3>
        <div class="row mt-5">
            @foreach ($truyenmoinhat as $item)
                <div class="col-md-2">
                    <img src="{{ asset('image/truyen/' . $item->slug . '/' . $item->hinhanh) }}" class="card-img-top"
                        alt="..." style="width: 200px; height: 230px;">
                    <h3>{{ $item->tentruyen }}</h3>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                autoplay: true,
                margin: 10,
                dots: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    },
                }
            })
        });
    </script>
@endsection
