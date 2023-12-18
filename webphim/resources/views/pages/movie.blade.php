@extends('layout')
@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="yoast_breadcrumb hidden-xs"><span><span><a
                                        href="{{ route('category', $movie->category->slug) }}">{{ $movie->category->title }}</a>
                                    »
                                    <span>
                                        @foreach ($movie->movie_genre as $gen)
                                            <a href="{{ route('genre', $gen->slug) }}">
                                                {{ $gen->title }}</a> »
                                        @endforeach
                                        <a
                                            href="{{ route('country', $movie->country->slug) }}">{{ $movie->country->title }}</a>
                                        » <span class="breadcrumb_last" aria-current="page">{{ $movie->title }}</span>
                                    </span></span></span></div>
                    </div>
                </div>
            </div>
            <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                <div class="ajax"></div>
            </div>
        </div>
        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
            <section id="content" class="test">
                <div class="clearfix wrap-content">

                    <div class="halim-movie-wrapper">
                        <div class="title-block">
                            <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                                <div class="halim-pulse-ring"></div>
                            </div>
                            <div class="title-wrapper" style="font-weight: bold;">
                                Bookmark
                            </div>
                        </div>
                        <div class="movie_info col-xs-12">
                            <div class="movie-poster col-md-3">
                                <img class="movie-thumb" src="{{ asset('image/movie') }}/{{ $movie->image }}"
                                    alt="{{ $movie->title }}">
                                @if ($movie->resolution != 2)
                                    @if (isset($episode_first->movie))
                                        <div class="bwa-content">
                                            <div class="loader"></div>
                                            {{-- {{ route('watch', ['slug'=>$movie->slug, 'tap-phim'=>$episode_first->episode]) }} --}}
                                            <a href="{{ url('xem-phim/' . $movie->slug . '/tap-' . $episode_first->episode) }}"
                                                class="bwac-btn">
                                                <i class="fa fa-play"></i>
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    <a href="#watch_trailer" class="btn btn-primary watch_trailer"
                                        style="display: block;">Xem Trailer</a>
                                @endif
                            </div>
                            <div class="film-poster col-md-9">
                                <h1 class="movie-title title-1"
                                    style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">
                                    {{ $movie->title }}</h1>
                                {{-- <h2 class="movie-title title-2" style="font-size: 12px;">Black Widow (2021)</h2> --}}
                                <ul class="list-info-group">
                                    <li class="list-info-group-item"><span>Trạng Thái</span> : <span class="quality">
                                            @if ($movie->resolution == 0)
                                                SD
                                            @elseif($movie->resolution == 1)
                                                HD
                                            @elseif($movie->resolution == 2)
                                                Trailer
                                            @endif
                                        </span>
                                        @if ($movie->resolution != 2)
                                            <span class="episode">
                                                @if ($movie->subtitle == 0)
                                                    Thuyết minh
                                                @else
                                                    Phụ đề
                                                @endif
                                            </span>
                                        @endif
                                    </li>
                                    {{-- <li class="list-info-group-item"><span>Điểm IMDb</span> : <span class="imdb">7.2</span></li> --}}
                                    <li class="list-info-group-item"><span>Thời lượng</span> :
                                        {{ $movie->time ? $movie->time : 'Chưa cập nhật' }}</li>
                                    <li class="list-info-group-item"><span>Số tập phim</span> :
                                        @if ($movie->resolution != 2)
                                            @if ($movie->category->slug == 'phim-bo')
                                                @if ($episode_cur_list_count == 0 && $movie->episodes == 0)
                                                    ??/?? tập
                                                @elseif($movie->episodes == 0)
                                                    {{ $episode_cur_list_count }}/?? tập
                                                @elseif($movie->episodes == $episode_cur_list_count)
                                                    {{ $episode_cur_list_count }}/{{ $movie->episodes }} tập - Hoàn thành
                                                @else
                                                    {{ $episode_cur_list_count }}/{{ $movie->episodes }} tập
                                                @endif
                                            @else
                                                1/1 tập - Hoàn thành
                                            @endif
                                        @else
                                            Đang cập nhậ<table></table>
                                        @endif
                                    </li>
                                    <li class="list-info-group-item"><span>Năm phát hành</span> :
                                        {{ $movie->year ? $movie->year : 'Chưa cập nhật' }}</li>
                                    <li class="list-info-group-item">
                                        <span>Thể loại</span> :
                                        @foreach ($movie->movie_genre as $gen)
                                            <a href="{{ route('genre', $gen->slug) }}" rel="category tag">
                                                {{ $gen->title }}</a>
                                        @endforeach

                                    </li>
                                    <li class="list-info-group-item"><span>Quốc gia</span> : <a
                                            href="{{ route('country', $movie->country->slug) }}"
                                            rel="tag">{{ $movie->country->title }}</a></li>
                                    @if ($movie->resolution != 2)
                                        <li class="list-info-group-item"><span>Tập phim mới nhất</span> :
                                            @if ($episode)
                                                @if ($movie->category->slug == 'phim-bo')
                                                    @foreach ($episode as $key => $ep)
                                                        {{-- {{ route('watch', ['slug'=>$ep->movie->slug, 'tap-phim'=>$ep->episode]) }} --}}
                                                        <a href="{{ url('xem-phim/' . $ep->movie->slug . '/tap-' . $ep->episode) }}"
                                                            rel="tag">{{ $ep->episode }}</a>
                                                    @endforeach
                                                @else
                                                    @foreach ($episode as $key => $ep)
                                                        <a href="{{ url('xem-phim/' . $ep->movie->slug . '/tap-' . $ep->episode) }}"
                                                            rel="tag">Full</a>
                                                    @endforeach
                                                @endif
                                            @endif
                                    @endif
                                    </li>
                                    {{-- <li class="list-info-group-item"><span>Đạo diễn</span> : <a class="director" rel="nofollow" href="https://phimhay.co/dao-dien/cate-shortland" title="Cate Shortland">Cate Shortland</a></li>
                         <li class="list-info-group-item last-item" style="-overflow: hidden;-display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-flex: 1;-webkit-box-orient: vertical;"><span>Diễn viên</span> : <a href="" rel="nofollow" title="C.C. Smiff">C.C. Smiff</a>, <a href="" rel="nofollow" title="David Harbour">David Harbour</a>, <a href="" rel="nofollow" title="Erin Jameson">Erin Jameson</a>, <a href="" rel="nofollow" title="Ever Anderson">Ever Anderson</a>, <a href="" rel="nofollow" title="Florence Pugh">Florence Pugh</a>, <a href="" rel="nofollow" title="Lewis Young">Lewis Young</a>, <a href="" rel="nofollow" title="Liani Samuel">Liani Samuel</a>, <a href="" rel="nofollow" title="Michelle Lee">Michelle Lee</a>, <a href="" rel="nofollow" title="Nanna Blondell">Nanna Blondell</a>, <a href="" rel="nofollow" title="O-T Fagbenle">O-T Fagbenle</a></li> --}}
                                </ul>
                                <div class="movie-trailer hidden"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div id="halim_trailer"></div>
                    <div class="clearfix"></div>
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="post-38424" class="item-content">
                                {!! $movie->description !!}
                            </article>
                        </div>
                    </div>
                    <!-- Tags phim-->
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Tags phim</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="post-38424" class="item-content">
                                @if ($movie->tags != null)
                                    @php
                                        $tags = [];
                                        $tags = explode(', ', $movie->tags);
                                    @endphp
                                    @foreach ($tags as $key => $tag)
                                        <a href="{{ route('tag', $tag) }}">{{ $tag }}</a>
                                    @endforeach
                                @else
                                    {{ $movie->tags }}
                                @endif
                            </article>
                        </div>
                    </div>
                    <!-- Trailer phim-->
                    @if ($movie->trailer != null)
                        <div class="section-bar clearfix">
                            <h2 class="section-title"><span style="color:#ffed4d">Trailer phim</span></h2>
                        </div>
                        <div class="entry-content htmlwrap clearfix">
                            <div class="video-item halim-entry-box">
                                <article id="watch_trailer" class="item-content">
                                    <iframe width="100%" height="350"
                                        src="https://www.youtube.com/embed/{{ $movie->trailer }}?si=V7ou-1LV4GIj4soV"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen></iframe>
                                </article>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
            <section class="related-movies">
                <div id="halim_related_movies-2xx" class="wrap-slider">
                    <div class="section-bar clearfix">
                        <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
                    </div>
                    <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                        @foreach ($movie_related as $key => $hot)
                            <article class="thumb grid-item post-38498">
                                <div class="halim-item">
                                    <a class="halim-thumb" href="{{ route('movie', $hot->slug) }}"
                                        title="{{ $hot->title }}">
                                        <figure><img class="lazy img-responsive"
                                                src="{{ asset('image/movie') }}/{{ $hot->image }}"
                                                alt="Đại Thánh Vô Song" title="Đại Thánh Vô Song"></figure>
                                        <span class="status">
                                            @if ($hot->resolution == 0)
                                                HD
                                            @else
                                                SD
                                            @endif
                                        </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                            @if ($hot->subtitle == 0)
                                                Thuyết minh
                                            @else
                                                Phụ đề
                                            @endif
                                        </span>
                                        <div class="icon_overlay"></div>
                                        <div class="halim-post-title-box">
                                            <div class="halim-post-title ">
                                                <p class="entry-title">{{ $hot->title }}</p>
                                                <p class="original_title">Monkey King: The One And Only</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    <!-- Comment fb-->
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Bình luận</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="watch_trailer" class="item-content">
                                @php
                                    $current_url = Request::url();
                                @endphp
                                <div style="background-color: #eee;">
                                    <div class="fb-comments" data-href="{{ $current_url }}" data-width="100%"
                                        data-numposts="10"></div>
                                </div>
                            </article>
                        </div>
                    </div>
                    <script>
                        jQuery(document).ready(function($) {
                            var owl = $('#halim_related_movies-2');
                            owl.owlCarousel({
                                loop: true,
                                margin: 4,
                                autoplay: true,
                                autoplayTimeout: 4000,
                                autoplayHoverPause: true,
                                nav: true,
                                navText: ['<i class="hl-down-open rotate-left"></i>',
                                    '<i class="hl-down-open rotate-right"></i>'
                                ],
                                responsiveClass: true,
                                responsive: {
                                    0: {
                                        items: 2
                                    },
                                    480: {
                                        items: 3
                                    },
                                    600: {
                                        items: 4
                                    },
                                    1000: {
                                        items: 4
                                    }
                                }
                            })
                        });
                    </script>

                </div>
            </section>
        </main>
        @include('pages.include.sidebar')
    </div>

@endsection
