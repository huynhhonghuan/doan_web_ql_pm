<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/admin" class="brand-link">
        <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">KeyD</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Bạn muốn tìm gì?"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if (Auth::user()->User_Role->first()->id == 'admin')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-bars"></i>
                            <p>
                                Danh Mục Phim
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.category.add') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm Danh Mục</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.category.list') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh Sách Danh Mục</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-copy"></i>
                            <p> Thể Loại
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.genre.add') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm Thể Loại</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.genre.list') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh Sách Thể Loại</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-globe"></i>
                            <p> Quốc Gia
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.country.add') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm Quốc Gia Phim</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.country.list') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh Sách Quốc Gia</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-film"></i>
                        <p> Phim
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="
                            @if (Auth::user()->User_Role->first()->id == 'admin') {{ route('admin.movie.add') }}
                            @else
                            {{ route('collaborators.movie.add') }}
                            @endif"
                                class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm Phim</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="@if (Auth::user()->User_Role->first()->id == 'admin') {{ route('admin.movie.list') }}
                                @else
                                {{ route('collaborators.movie.list') }}
                                @endif" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách Phim</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-file-video"></i>
                        <p> Tập Phim
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="@if (Auth::user()->User_Role->first()->id == 'admin') {{ route('admin.movie.list') }}
                                @else
                                {{ route('collaborators.movie.list') }}
                                @endif" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm Tập Phim</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="@if (Auth::user()->User_Role->first()->id == 'admin') {{ route('admin.episode.list') }}
                                @else
                                {{ route('collaborators.episode.list') }}
                                @endif" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách Tập Phim</p>
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
