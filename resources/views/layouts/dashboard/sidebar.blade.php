<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Menu Samping -->
        <div id="sidebar-menu">
            <!-- Awal Menu Kiri -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Beranda</li>

                <li class="{{ Request::is('dashboard') ? 'mm-active' : '' }}">
                    <a href="{{ route('dashboard') }}"
                        class="waves-effect {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="ti-home"></i>Beranda
                    </a>
                </li>

                @role('Superadmin')
                    <li class="menu-title">Manajemen Pengguna</li>

                    <li class="{{ Request::is('users/*') ? 'mm-active' : '' }}">
                        <a href="{{ route('users') }}" class="waves-effect {{ Request::is('users/*') ? 'active' : '' }}">
                            <i class="fa fa-users"></i>
                            <span>Semua Pengguna</span>
                        </a>
                    </li>
                @endrole

                <li class="menu-title">Manajemen Siswa</li>

                <li class="{{ Request::is('member/*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);"
                        class="has-arrow waves-effect {{ Request::is('member/list') ? ' mm-active' : '' }}">
                        <i class="fa fa-id-card"></i>
                        <span>Siswa</span>
                    </a>
                    <ul class="sub-menu {{ Request::is('member/*') ? 'mm-collapse mm-show' : '' }}"
                        aria-expanded="false">
                        <li class="{{ Request::is('siswa/*') ? 'mm-active' : '' }}"><a
                                href="{{ route('siswa') }}"><span
                                    class="badge rounded-pill bg-primary float-end">{{ \App\Models\User::where('role', 'Siswa')->count() }}</span>
                                <span>Semua Siswa</span></a></li>
                    </ul>
                </li>

                <li class="menu-title">Manajemen Buku</li>

                <li class="{{ Request::is('kategori-buku/list') ? 'mm-active' : '' }}">
                    <a href="{{ route('kategori') }}"
                        class="waves-effect {{ Request::is('kategori-buku/list') ? 'active' : '' }}">
                        <i class="ti-bookmark-alt"></i><span
                            class="badge rounded-pill bg-primary float-end">{{ \App\Models\KategoriBuku::count() }}</span>
                        <span>Kategori Buku</span>
                    </a>
                </li>

                <li class="{{ Request::is('buku/list') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);"
                        class="has-arrow waves-effect {{ Request::is('buku/list') ? ' mm-active' : '' }}">
                        <i class="fa fa-book"></i>
                        <span>Buku</span>
                    </a>
                    <ul class="sub-menu {{ Request::is('buku/list') ? 'mm-collapse mm-show' : '' }}"
                        aria-expanded="false">
                        <li class="{{ Request::is('buku/list') ? 'mm-active' : '' }}"><a
                                href="{{ route('buku') }}"><span
                                    class="badge rounded-pill bg-primary float-end">{{ \App\Models\Buku::count() }}</span>
                                <span>Semua Buku</span></a></li>
                    </ul>
                </li>

                @role('Superadmin')
                    <li class="{{ Request::is('denda/*') ? 'mm-active' : '' }}">
                        <a href="{{ route('denda.setting') }}"
                            class="waves-effect {{ Request::is('denda/*') ? 'active' : '' }}">
                            <i class="mdi mdi-cash-multiple"></i> Pengaturan Denda
                        </a>
                    </li>
                @endrole

                <li class="menu-title">Manajemen Perpustakaan</li>

                <li class="{{ Request::is('peminjaman/list') ? 'mm-active' : '' }}">
                    <a href="{{ route('peminjaman') }}"
                        class="waves-effect {{ Request::is('peminjaman/list') ? 'active' : '' }}">
                        <i class="fa fa-share"></i><span class="badge rounded-pill bg-primary float-end"></span>
                        <span>Peminjaman Buku</span>
                    </a>
                </li>

                <li class="{{ Request::is('pengembalian/list') ? 'mm-active' : '' }}">
                    <a href="{{ route('pengembalian') }}"
                        class="waves-effect {{ Request::is('pengembalian/list') ? 'active' : '' }}">
                        <i class="fa fa-reply"></i><span class="badge rounded-pill bg-primary float-end"></span>
                        <span>Pengembalian Buku</span>
                    </a>
                </li>

                @role('Superadmin')
                    <li class="menu-title">Laporan</li>
                    <li class="{{ Request::is('laporan/form') ? 'mm-active' : '' }}">
                        <a href="{{ route('cetak.form') }}"
                            class="waves-effect {{ Request::is('laporan/form') ? 'active' : '' }}">
                            <i class="fa fa-download"></i> Laporan Perpustakaan
                        </a>
                    </li>
                @endrole
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
