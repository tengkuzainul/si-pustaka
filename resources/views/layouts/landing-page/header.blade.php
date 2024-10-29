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
                        <a href="{{ route('login') }}" class="user-account for-buy"><i
                                class="icon icon-user"></i><span>&nbsp;Login
                                Administrator</span></a>

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
                                        href="{{ url('/') }}">Home</a></li>

                                <li class="menu-item {{ Request::is('books/books-catalog') ? 'active' : '' }}"><a
                                        href="{{ route('book.catalog') }}" class="nav-link">Books
                                        Catalog</a></li>
                                </li>
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
