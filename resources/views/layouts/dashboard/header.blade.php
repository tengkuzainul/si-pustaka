<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/dashboard/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/dashboard/images/logo-dark.png') }}" alt="" height="17">
                    </span>
                </a>

                <a href="{{ route('dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/dashboard/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/dashboard/images/logo-light.png') }}" alt="" height="18">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-menu"></i>
            </button>
        </div>

        <div class="d-flex">
            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="fa fa-search"></span>
                </div>
            </form>

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..."
                                    aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="mdi mdi-fullscreen"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="mdi mdi-bell-outline"></i>
                    <span id="notification-badge" class="badge bg-danger rounded-pill">0</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="m-0 font-size-16"> Notifications</h5>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;" id="notification-list">
                        <!-- Notifikasi baru akan ditambahkan di sini secara dinamis -->
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user"
                            src="{{ Auth::user()->image ? Storage::url(Auth::user()->image) : 'https://ui-avatars.com/api/?name=' . Auth::user()->name . '&background=000&color=fdfdfd&rounded=true' }}"
                            alt="Header Avatar">
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" href="{{ route('profile.edit') }}"><i
                                class="mdi mdi-account-circle font-size-17 align-middle me-1"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="#"
                            onclick="event.preventDefault(); document.getElementById('formLogout').submit();"><i
                                class="mdi mdi-power font-size-17 align-middle me-1 text-danger"></i> Logout</a>

                        <form action="{{ route('logout') }}" id="formLogout" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
</header>

{{-- link jquery --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function getNotif() {
        $.ajax({
            url: "{{ route('notification.fetch') }}",
            type: "GET",
            success: function(response) {
                $('#notification-badge').text(response.body.count);

                $('#notification-list').empty();

                if (response.body.notification.length == 0) {
                    $('#notification-list').append(`
                        <div class="text-center">
                            <h6 class="text-muted">Tidak ada notifikasi</h6>
                        </div>
                    `);
                    return;
                }

                response.body.notification.forEach(function(element) {
                    let date = new Date(element.created_at);
                    let diff = Math.abs(new Date() - date);
                    let timeAgo = diff < 60000 ? 'Baru saja' :
                        diff < 3600000 ? Math.floor(diff / 60000) + ' menit yang lalu' :
                        diff < 86400000 ? Math.floor(diff / 3600000) + ' jam yang lalu' :
                        Math.floor(diff / 86400000) + ' hari yang lalu';

                    let icon = '';
                    switch (element.type) {
                        case 'warning':
                            icon = '<i class="fa fa-exclamation-circle text-warning"></i>';
                            break;
                        case 'danger':
                            icon = '<i class="fa fa-times-circle text-danger"></i>';
                            break;
                        case 'success':
                            icon = '<i class="fa fa-check-circle text-success"></i>';
                            break;
                        default:
                            icon = '<i class="fa fa-info-circle text-primary"></i>';
                    }

                    $('#notification-list').append(`
                        <div class="notification-item p-2" id="${element.id}" style="cursor: pointer;">
    <div class="d-flex align-items-start">
        ${icon}
        <div class="ms-3">
            <h6 class="mb-1">${element.title}</h6>
            <p class="text-muted mb-0">${element.message}</p>
            <small class="text-muted">${timeAgo}</small>
        </div>
    </div>
    <hr class="dropdown-divider">
</div>

                    `);
                });
            }
        });
    }

    getNotif();

    setInterval(getNotif, 2000);

    $('#notification-list').on('click', '.notification-item', function() {
        let id = $(this).attr('id');
        $.ajax({
            url: "{{ route('notification.read') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            success: function(response) {
                getNotif();
            }
        });
    });

    $('#notification-list').on('click', '.notification-item', function(e) {
        e.stopPropagation();
    });
</script>
