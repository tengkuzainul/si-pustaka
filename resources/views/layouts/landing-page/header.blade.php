<div id="header-wrap">

    <div class="top-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="social-links">
                        <ul>
                            <li>
                                <a href="{{ url('/') }}"><i class="icon icon-facebook"></i></a>
                            </li>
                            <li>
                                <a href="{{ url('/') }}"><i class="icon icon-twitter"></i></a>
                            </li>
                            <li>
                                <a href="{{ url('/') }}"><i class="icon icon-youtube-play"></i></a>
                            </li>
                            <li>
                                <a href="{{ url('/') }}"><i class="icon icon-behance-square"></i></a>
                            </li>
                        </ul>
                    </div><!--social-links-->
                </div>
                <div class="col-md-6">
                    <div class="right-element">
                        @guest
                            <a href="{{ route('login') }}" class="user-account for-buy"><i
                                    class="icon icon-user"></i><span>&nbsp;Login
                                    Portal</span></a>
                        @endguest

                        @auth
                            <a href="{{ url('/') }}" class="user-account for-buy" style="pointer-events: none"><i
                                    class="icon icon-user"></i><span>&nbsp;{{ Auth::user()->name }}</span></a>
                            <a href="{{ route('login') }}" class="user-account for-buy" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"><i class="fa fa-sign-out"></i><span>&nbsp;Logout</span></a>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hi, {{ Auth::user()->name }}
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-start fw-bold text-capitalize fs-3">Apakah anda yakin ingin
                                                logout?
                                            </p>
                                        </div>
                                        <div class="modal-footer gap-3">
                                            <button type="button" class="btn btn-secondary rounded"
                                                data-bs-dismiss="modal">Tidak</button>
                                            <button type="button" class="btn btn-primary rounded"
                                                onclick="event.preventDefault(); document.getElementById('formLogout').submit();">Ya,
                                                Yakin</button>

                                            <form action="{{ route('logout') }}" id="formLogout" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endauth

                        <div class="action-menu">

                            <div class="search-bar">
                                <a href="#" class="search-button search-toggle" data-selector="#header-wrap">
                                    <i class="icon icon-search"></i>
                                </a>
                                <form role="search" method="get" class="search-box">
                                    <input class="search-field text search-input" placeholder="Search" type="search">
                                </form>
                            </div>
                        </div>

                    </div><!--top-right-->
                </div>

            </div>
        </div>
    </div><!--top-content-->

    <header id="header">
        <div class="container-fluid">
            <div class="row align-items-center">

                <div class="col-md-4">
                    <div class="main-logo">
                        <h1 class=" display-4 text-dark">SI-PERPUS</h1>
                    </div>

                </div>

                <div class="col-md-8">

                    <nav id="navbar">
                        <div class="main-menu stellarnav">
                            <ul class="menu-list">
                                <li class="menu-item {{ Request::is('/') ? 'active' : '' }}"><a
                                        href="{{ url('/') }}">Beranda</a></li>

                                <li class="menu-item {{ Request::is('books/books-catalog') ? 'active' : '' }}"><a
                                        href="{{ route('book.catalog') }}" class="nav-link">Katalog Buku</a></li>
                                </li>

                                @auth
                                    <li class="menu-item {{ Request::is('books/books-catalog') ? 'active' : '' }}"><a
                                            href="{{ route('book.catalog') }}" class="nav-link">Data Peminjaman Saya</a>
                                    </li>
                                    </li>
                                @endauth
                            </ul>

                            <div class="hamburger">
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                            </div>

                        </div>
                    </nav>

                </div>

            </div>
        </div>
    </header>

</div><!--header-wrap-->
