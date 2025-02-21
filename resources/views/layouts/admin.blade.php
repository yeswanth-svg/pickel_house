<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title', 'Admin')</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{assert('admin/img/kaiadmin/favicon.ico')}}" type="image/x-icon" />



    <!-- Fonts and icons -->
    <script src="{{asset('admin/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
        WebFont.load({
            google: { families: ["Public Sans:300,400,500,600,700"] },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{asset('admin/css/fonts.min.css')}}"],
            },
            active: function () {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/plugins.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/kaiadmin.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/demo.css')}}" />



    <!-- 

    <style>
        .notification {
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }
    </style> -->
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="light">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="red2">
                    <a href="{{route('admin.dashboard')}}" class="logo">
                        <!-- <img src="{{asset('admin/img/kaiadmin/logo_dark.svg')}}" alt="navbar brand" class="navbar-brand"
                            height="20" /> -->
                        <h2 class="text-light">Pickel House</h2>
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item {{request()->is('admin/dashboard') ? 'active' : ''}}">
                            <a href="{{route('admin.dashboard')}}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>

                            </a>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Cookbook Recipes</h4>
                        </li>
                        <li class="nav-item {{ request()->is('admin/category*') ? 'active' : '' }}">
                            <a href="{{route('admin.category.index')}}">
                                <i class="fas fa-layer-group"></i>
                                <p>Categories</p>
                                <!-- <span class="caret"></span> -->
                            </a>
                        </li>

                        <li class="nav-item {{request()->is('admin/dishes*') ? 'active' : ''}}">
                            <a href="{{route('admin.dishes.index')}}">
                                <i class="fas fa-mortar-pestle"></i>
                                <p>Dishes</p>
                                <!-- <span class="caret"></span> -->
                            </a>

                        </li>

                        <li class="nav-item {{request()->is('admin/quantity*') ? 'active' : ''}}">
                            <a href="{{route('admin.quantity.index')}}">
                                <i class="fas fa-mortar-pestle"></i>
                                <p>Dish Quantites</p>
                                <!-- <span class="caret"></span> -->
                            </a>

                        </li>


                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#order"
                                aria-expanded="{{ request()->is('admin/orders*') && !request()->is('admin/orders/payment*') ? 'true' : 'false' }}"
                                aria-controls="order">
                                <i class="fas fa-pen-square"></i>
                                <p>Orders</p>
                                <span class="caret"></span>
                            </a>

                            <!-- Show only if not under Order Payments -->
                            <div class="collapse {{ request()->is('admin/orders*') && !request()->is('admin/orders/payment*') ? 'show' : '' }}"
                                id="order">
                                <ul class="nav nav-collapse">
                                    <li class="{{ request()->is('admin/orders') ? 'active' : '' }}">
                                        <a href="{{ route('admin.orders.index') }}"><span class="sub-item">All
                                                Orders</span></a>
                                    </li>
                                    <li class="{{ request()->is('admin/orders/confirmed') ? 'active' : '' }}">
                                        <a href="{{ route('admin.orders.confirmed') }}"><span class="sub-item">Confirmed
                                                Orders</span></a>
                                    </li>
                                    <li class="{{ request()->is('admin/orders/processing') ? 'active' : '' }}">
                                        <a href="{{ route('admin.orders.processing') }}"><span
                                                class="sub-item">Processing Orders</span></a>
                                    </li>
                                    <li class="{{ request()->is('admin/orders/packing') ? 'active' : '' }}">
                                        <a href="{{ route('admin.orders.packing') }}"><span class="sub-item">Packing
                                                Orders</span></a>
                                    </li>
                                    <li class="{{ request()->is('admin/orders/shipped') ? 'active' : '' }}">
                                        <a href="{{ route('admin.orders.shipped') }}"><span class="sub-item">Shipped
                                                Orders</span></a>
                                    </li>
                                    <li class="{{ request()->is('admin/orders/completed') ? 'active' : '' }}">
                                        <a href="{{ route('admin.orders.completed') }}"><span class="sub-item">Completed
                                                Orders</span></a>
                                    </li>
                                    <li class="{{ request()->is('admin/orders/cancelled') ? 'active' : '' }}">
                                        <a href="{{ route('admin.orders.cancelled') }}"><span class="sub-item">Cancelled
                                                Orders</span></a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#payment"
                                aria-expanded="{{ request()->is('admin/orders/payment*') ? 'true' : 'false' }}"
                                aria-controls="payment">
                                <i class="fas fa-credit-card"></i>
                                <p>Order Payments</p>
                                <span class="caret"></span>
                            </a>

                            <!-- Show only for payment routes -->
                            <div class="collapse {{ request()->is('admin/orders/payment*') ? 'show' : '' }}"
                                id="payment">
                                <ul class="nav nav-collapse">
                                    <li class="{{ request()->is('admin/orders/payment/pending') ? 'active' : '' }}">
                                        <a href="{{ route('admin.orders.payment.pending') }}"><span
                                                class="sub-item">Pending Payments</span></a>
                                    </li>
                                    <li class="{{ request()->is('admin/orders/payment/processing') ? 'active' : '' }}">
                                        <a href="{{ route('admin.orders.payment.processing') }}"><span
                                                class="sub-item">Processing Payments</span></a>
                                    </li>
                                    <li class="{{ request()->is('admin/orders/payment/failed') ? 'active' : '' }}">
                                        <a href="{{ route('admin.orders.payment.failed') }}"><span
                                                class="sub-item">Failed Payments</span></a>
                                    </li>
                                    <li class="{{ request()->is('admin/orders/payment/completed') ? 'active' : '' }}">
                                        <a href="{{ route('admin.orders.payment.completed') }}"><span
                                                class="sub-item">Completed Payments</span></a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.razorpay_transactions')}}">
                                <i class="fas fa-coins"></i>
                                <p>Transactions</p>
                            </a>

                        </li>





                        <li class="nav-item {{request()->is('admin/users*') ? 'active' : ''}}">
                            <a href="{{route('admin.users.index')}}">
                                <i class="fas fa-user"></i>
                                <p>Users</p>
                            </a>

                        </li>

                        <li class="nav-item {{request()->is('admin/coupons*') ? 'active' : ''}}">
                            <a href="{{route('admin.coupons.index')}}">
                                <i class="fas fa-coins"></i>
                                <p>Cupons</p>
                            </a>

                        </li>
                        <li class="nav-item {{request()->is('admin/rewards*') ? 'active' : ''}}">
                            <a href="{{route('admin.rewards.index')}}">
                                <i class="fas fa-gift"></i>
                                <p>Rewards</p>
                            </a>

                        </li>

                        <li class="nav-item {{request()->is('admin/shipping_zones*') ? 'active' : ''}}">
                            <a href="{{route('admin.shipping_zones.index')}}">
                                <i class="fas fa-globe-americas"></i>
                                <p>Shipping Zones</p>
                            </a>

                        </li>

                        <li class="nav-item {{request()->is('admin/settings*') ? 'active' : ''}}">
                            <a href="{{route('admin.settings.index')}}">
                                <i class="fas fa-cog"></i>
                                <p>Settings</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#ticket"
                                aria-expanded="{{ request()->is('admin/tickets') || request()->is('admin/tickets/*') || request()->is('admin/tickets-categories/*') ? 'true' : 'false' }}"
                                aria-controls="ticket">
                                <i class="fas fa-ticket-alt"></i>
                                <p>Support Tickets</p>
                                <span class="caret"></span>
                            </a>

                            <!-- Show only for ticket routes -->
                            <div class="collapse {{ request()->is('admin/tickets') || request()->is('admin/tickets/*') ? 'show' : '' }}"
                                id="ticket">
                                <ul class="nav nav-collapse">
                                    <li
                                        class="{{ request()->is('admin/tickets') || request()->is('admin/tickets/*') && !request()->is('admin/tickets-categories*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.tickets.index') }}">
                                            <span class="sub-item">All Tickets</span>
                                        </a>
                                    </li>
                                    <li
                                        class="{{ request()->is('admin/tickets-categories') || request()->is('admin/tickets-categories/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.tickets-categories.index') }}">
                                            <span class="sub-item">Tickets Category</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item {{request()->is('admin/newsletter*') ? 'active' : ''}}">
                            <a href="{{route('admin.newsletter.index')}}">
                                <i class="fas fa-paper-plane"></i>
                                <p>Newsletter</p>
                            </a>
                        </li>



                    </ul>
                </div>
            </div>
        </div>




        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="red2">
                        <a href="" class="logo">
                            <img src="{{asset('admin/img/kaiadmin/logo_light.svg')}}" alt="navbar brand"
                                class="navbar-brand" height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
                    data-background-color="red2">
                    <div class="container-fluid">
                        <!-- <nav
                            class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-search pe-1">
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </div>
                                <input type="text" placeholder="Search ..." class="form-control" />
                            </div>
                        </nav> -->

                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                                    aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-search"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-search animated fadeIn">
                                    <form class="navbar-left navbar-form nav-search">
                                        <div class="input-group">
                                            <input type="text" placeholder="Search ..." class="form-control" />
                                        </div>
                                    </form>
                                </ul>
                            </li>
                            <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                                    aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-search"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-search animated fadeIn">
                                    <form class="navbar-left navbar-form nav-search">
                                        <div class="input-group">
                                            <input type="text" placeholder="Search ..." class="form-control" />
                                        </div>
                                    </form>
                                </ul>
                            </li>


                            <!-- notification li tag -->
                            <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <span class="notification" id="notificationCount">{{ $unreadCount ?? 0 }}</span>
                                </a>
                                <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                    <li>
                                        <div class="dropdown-title">
                                            You have <span id="unreadCount">{{ $unreadCount ?? 0 }}</span> new
                                            notifications
                                        </div>
                                    </li>
                                    <li>
                                        <div class="notif-scroll scrollbar-outer">
                                            <div class="notif-center">
                                                @if ($latestNotificationCount->isNotEmpty())
                                                    @foreach ($latestNotificationCount as $notification)
                                                        <a href="#">
                                                            <div class="notif-icon notif-primary">
                                                                <i class="fa fa-info-circle"></i>
                                                            </div>
                                                            <div class="notif-content">
                                                                <span class="block">
                                                                    {{ $notification->data['payment_method'] ?? 'Notification' }}
                                                                    -
                                                                    {{ $notification->data['status'] ?? '' }}
                                                                </span>
                                                                <span class="block">
                                                                    Total:
                                                                    ₹{{ number_format($notification->data['total_amount'] / 100, 2) }}
                                                                </span>
                                                                <span
                                                                    class="time">{{ $notification->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </a>

                                                    @endforeach
                                                @else
                                                    <p class="text-center">No new notifications</p>
                                                @endif

                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="see-all" href="{{ route('admin.notifications') }}">
                                            See all notifications <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>


                            <!-- //messages li tag -->
                            <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-envelope"></i>
                                </a>
                                <ul class="dropdown-menu messages-notif-box animated fadeIn"
                                    aria-labelledby="messageDropdown">
                                    <li>
                                        <div class="dropdown-title d-flex justify-content-between align-items-center">
                                            Messages
                                            <a href="#" class="small">Mark all as read</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-notif-scroll scrollbar-outer">
                                            <div class="notif-center">
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img src="{{asset('admin/img/jm_denis.jpg')}}"
                                                            alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Jimmy Denis</span>
                                                        <span class="block"> How are you ? </span>
                                                        <span class="time">5 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img src="{{asset('admin/img/chadengle.jpg')}}"
                                                            alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Chad</span>
                                                        <span class="block"> Ok, Thanks ! </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img src="{{asset('admin/img/mlane.jpg')}}" alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Jhon Doe</span>
                                                        <span class="block">
                                                            Ready for the meeting today...
                                                        </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img src="{{asset('admin/img/talha.jpg')}}" alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Talha</span>
                                                        <span class="block"> Hi, Apa Kabar ? </span>
                                                        <span class="time">17 minutes ago</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="see-all" href="javascript:void(0);">See all messages<i
                                                class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>



                            <!-- quick action li tag -->
                            <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                    <i class="fas fa-layer-group"></i>
                                </a>
                                <div class="dropdown-menu quick-actions animated fadeIn">
                                    <div class="quick-actions-header">
                                        <span class="title mb-1">Quick Actions</span>
                                        <span class="subtitle op-7">Shortcuts</span>
                                    </div>
                                    <div class="quick-actions-scroll scrollbar-outer">
                                        <div class="quick-actions-items">
                                            <div class="row m-0">
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-danger rounded-circle">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </div>
                                                        <span class="text">Calendar</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-warning rounded-circle">
                                                            <i class="fas fa-map"></i>
                                                        </div>
                                                        <span class="text">Maps</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-info rounded-circle">
                                                            <i class="fas fa-file-excel"></i>
                                                        </div>
                                                        <span class="text">Reports</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-success rounded-circle">
                                                            <i class="fas fa-envelope"></i>
                                                        </div>
                                                        <span class="text">Emails</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-primary rounded-circle">
                                                            <i class="fas fa-file-invoice-dollar"></i>
                                                        </div>
                                                        <span class="text">Invoice</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-secondary rounded-circle">
                                                            <i class="fas fa-credit-card"></i>
                                                        </div>
                                                        <span class="text">Payments</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>



                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                                    aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img src="{{asset('admin/img/mlane.jpg')}}" alt="..."
                                            class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold">Admin</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <!-- <div class="avatar-lg">
                                                    <img src="{{asset('images/profile.jpg')}}" alt="image profile"
                                                        class="avatar-img rounded" />
                                                </div> -->
                                                <div class="u-text">
                                                    <h4>{{auth()->user()->name}}</h4>
                                                    <p class="text-muted">{{auth()->user()->email}}</p>
                                                    <a href="{{route('profile.edit')}}"
                                                        class="btn btn-xs btn-secondary btn-sm">View
                                                        Profile</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <form method="POST" action="{{ route('logout') }}" class="m-3">
                                                @csrf
                                                <button class="btn btn-danger btn-sm ms-auto"><i
                                                        class="fas fa-sign-out-alt"></i> Logout</button>
                                            </form>

                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
            <!-- End Sidebar -->
            @yield('content')
        </div>

    </div>




    <!-- jQuery -->
    <audio id="notificationSound" src="{{ asset('sounds/notification.mp3') }}" preload="auto"></audio>

    <script>
        let lastNotificationCount = parseInt(document.getElementById('notificationCount').innerText);

        setInterval(function () {
            fetch('{{ route("admin.notifications.count") }}')
                .then(response => response.json())
                .then(data => {
                    const newNotificationCount = data.unreadCount;

                    if (newNotificationCount > lastNotificationCount) {
                        const audio = document.getElementById('notificationSound');
                        audio.play().catch(error => console.error('Audio play error:', error));
                        document.getElementById('notificationCount').innerText = newNotificationCount;
                    }

                    lastNotificationCount = newNotificationCount;
                })
                .catch(error => console.error('Error fetching notifications:', error));
        }, 5000);
    </script>



    <!--   Core JS Files   -->
    <script src="{{asset('admin/js/core/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('admin/js/core/popper.min.js')}}"></script>
    <script src="{{asset('admin/js/core/bootstrap.min.js')}}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{asset('admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

    <!-- Chart JS -->
    <script src="{{asset('admin/js/plugin/chart.js/chart.min.js')}}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{asset('admin/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Chart Circle -->
    <script src="{{asset('admin/js/plugin/chart-circle/circles.min.js')}}"></script>

    <!-- Datatables -->
    <script src="{{asset('admin/js/plugin/datatables/datatables.min.js')}}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{asset('admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{asset('admin/js/plugin/jsvectormap/jsvectormap.min.js')}}"></script>
    <script src="{{asset('admin/js/plugin/jsvectormap/world.js')}}"></script>

    <!-- Sweet Alert -->
    <script src="{{asset('admin/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{asset('admin/js/kaiadmin.min.js')}}"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{asset('admin/js/setting-demo.js')}}"></script>
    <script src="{{asset('admin/js/demo.js')}}"></script>

    <script>
        $(document).ready(function () {
            // Success notification
            @if(session('success'))
                var content = {
                    message: "{{ session('success') }}",
                    title: "Success",
                    icon: "fa fa-bell"
                };

                $.notify(content, {
                    type: 'success', // You can change this to match your notification type
                    placement: {
                        from: 'top', // Correct capitalization
                        align: 'right' // Correct capitalization
                    },
                    time: 1000,
                    delay: 5000, // Adjust delay if needed
                });
            @endif


            // Error notification
            @if($errors->any())
                var content = {
                    message: "{{ $errors->first() }}",
                    title: "Error",
                    icon: "fa fa-exclamation-circle",
                };

                $.notify(content, {
                    type: "danger", // Error style
                    allow_dismiss: true,
                    delay: 5000,
                    placement: {
                        from: "top",
                        align: "right",
                    },
                    offset: { x: 20, y: 70 },
                    animate: {
                        enter: "animated fadeInDown",
                        exit: "animated fadeOutUp",
                    },
                });
            @endif

        });
    </script>

    <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });
    </script>
</body>

</html>