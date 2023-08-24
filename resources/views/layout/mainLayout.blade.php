<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Black Bull Application">
    <title>:: Black Bull Admin ::</title>
    <!-- App favicon -->
    <link rel="icon" href="{{asset('imgs/logo.ico')}}" sizes="32x32">

    <!-- Bootstrap Css -->
    <link href="{{asset('/assets/css/bootstrap.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{asset('/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/izitoast/dist/css/iziToast.min.css">
    <!-- App Css-->
    <link href="{{asset('/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css"  />
    <!-- DataTables -->
    <link href="{{asset('/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('/assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />


</head>

<!-- <body data-layout="horizontal" data-topbar="dark"> -->

<!-- Begin page -->
<div id="layout-wrapper">
    <div id="preloader" style="display: none;">
        <div id="status" style="display: none;">
            <div class="spinner">
                <i class="ri-loader-line spin-icon"></i>
            </div>

        </div>
    </div>

    <header id="page-topbar">

        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{asset('assets/images/logo-sm.png')}}" alt="logo-sm" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('assets/imgs/login_logo.jpeg')}}" alt="logo-dark" height="55">
                        </span>
                    </a>

                    <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/logo-sm.png')}}" alt="logo-sm-light" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/logo-light.png')}}" alt="logo-light" height="20">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                    <i class="ri-menu-2-line align-middle"></i>
                </button>

                <!-- App Search-->
                <form class="app-search d-none d-lg-block">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="ri-search-line"></span>
                    </div>
                </form>
            </div>

            <div class="d-flex">

                <div class="dropdown d-inline-block d-lg-none ms-2">
                    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ri-search-line"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                            <div class="mb-3 m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>





                <div class="dropdown d-none d-lg-inline-block ms-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="ri-fullscreen-line"></i>
                    </button>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-notification-3-line"></i>
                        <span class="noti-dot"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0"> Notifications </h6>
                                </div>
                                <div class="col-auto">
                                    <a href="#!" class="small"> View All</a>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 230px;">
                            <a href="" class="text-reset notification-item">
                                <div class="d-flex">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="ri-shopping-cart-line"></i>
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="mb-1">Your order is placed</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">If several languages coalesce the grammar</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="" class="text-reset notification-item">
                                <div class="d-flex">
                                    <img src="{{ asset('assets/images/users/avatar-3.jpg')}}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                    <div class="flex-1">
                                        <h6 class="mb-1">James Lemire</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">It will seem like simplified English.</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="" class="text-reset notification-item">
                                <div class="d-flex">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-success rounded-circle font-size-16">
                                            <i class="ri-checkbox-circle-line"></i>
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="mb-1">Your item is shipped</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">If several languages coalesce the grammar</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="" class="text-reset notification-item">
                                <div class="d-flex">
                                    <img src="{{ asset('assets/images/users/avatar-4.jpg')}}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                    <div class="flex-1">
                                        <h6 class="mb-1">Salena Layfield</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="p-2 border-top">
                            <div class="d-grid">
                                <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                    <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dropdown d-inline-block user-dropdown">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="//gravatar.com/avatar/{{ Auth::guard('admin')->user()->email }}?s=100" alt="Header Avatar">
                        <span class="d-none d-xl-inline-block ms-1">{{ Auth::guard('admin')->user()->display_name }}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" href="../master/employee_profile.php?id={{Auth::guard('admin')->user()->id}}"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                        <a class="dropdown-item" href="../users/dashboard.php"><i class="ri-wallet-2-line align-middle me-1"></i> Dashboard</a>
                        <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end mt-1">11</span><i class="ri-settings-2-line align-middle me-1"></i> Settings</a>
                        <a class="dropdown-item" href="{{route('logout')}}"><i class="ri-lock-unlock-line align-middle me-1"></i> Lock
                            screen</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="{{route('logout')}}"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                    </div>
                </div>



            </div>
        </div>
    </header>

    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

        <div data-simplebar class="h-100">

            <!-- User details -->
            <div class="user-profile text-center mt-3">
                <div class="">
                    <img src="//gravatar.com/avatar/{{ Auth::guard('admin')->user()->email }}?s=100" alt="" class="avatar-md rounded-circle">
                </div>
                <div class="mt-3">
                    <h4 class="font-size-16 mb-1">{{ Auth::guard('admin')->user()->display_name }}</h4>
                    <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
                </div>
            </div>

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li><a href="{{route('admin.dashboard')}}"  class="wave-effect"><i class="mdi mdi-desktop-mac-dashboard"></i><span>Dashboard</span></a></li>
                    <li><a href="#"  class="has-arrow wave-effect"><i class="mdi mdi-tools"></i><span>Master</span></a>
                        <ul class="sub-menu mm-collapse" aria-expanded="false">
                            <li><a href="../master/menu.php"><i class="mdi mdi-book-account"></i> Customers</a></li>
                            <li><a href="../master/department.php"><i class="mdi mdi-account-card"></i> Department</a></li>
                            <li><a href="{{route('admin.branch.index')}}"><i class="mdi mdi-account-box-multiple-outline"></i>Branch</a></li>
                            <li><a href="{{route('admin.supplier.index')}}"><i class="mdi mdi-account-switch"></i>Supplier</a></li>
                            <li><a href="{{route('admin.category.index')}}"><i class="mdi mdi-application-cog"></i>Category</a></li>
                            <li><a href="{{route('admin.manufacture.index')}}"><i class="mdi mdi-application-cog"></i>Manufacture</a></li>
                            <li><a href="{{route('admin.tyresize.index')}}"><i class="mdi mdi-move-resize"></i>Tyre Size</a></li>
                        </ul>
                    </li>
                    <li><a href="#"  class="has-arrow wave-effect"><i class="mdi mdi-card-account-details-star"></i><span>Product</span></a>
                        <ul class="sub-menu mm-collapse" aria-expanded="false">
                            <li><a href="{{route('admin.tyre.index')}}"><i class="mdi mdi-tire"></i>Tyre</a></li>
                            <li><a href="{{route('admin.tube.index')}}"><i class="mdi mdi-circle-double"></i>Tube</a></li>
                            <li><a href="{{route('admin.battery.index')}}"><i class="mdi mdi-car-battery"></i>Battery</a></li>
                            <li><a href="{{route('admin.productstock.index')}}"><i class="mdi mdi-car-battery"></i>Stock</a></li>
                        </ul>
                    </li>
                    <li><a href="#"  class="has-arrow wave-effect"><i class="mdi mdi-wallet-plus"></i><span>Purchase</span></a>
                        <ul class="sub-menu mm-collapse" aria-expanded="false">
                            <li><a href="{{route('admin.purchase.index')}}"><i class="mdi mdi-database-arrow-left"></i>Purchase Order</a></li>
                        </ul>
                    </li>
                    <li><a href="#"  class="has-arrow wave-effect"><i class="mdi mdi-sale"></i><span>Product Sales</span></a>
                        <ul class="sub-menu mm-collapse" aria-expanded="false">
                            <li><a href="{{route('admin.sales.index')}}"><i class="mdi mdi-database-arrow-right"></i>Sales</a></li>
                        </ul>
                    </li>
                    <li><a href="#"  class="has-arrow wave-effect"><i class="mdi mdi-account-group"></i><span>Customers</span></a>
                        <ul class="sub-menu mm-collapse" aria-expanded="false">
                            <li><a href="{{route('admin.purchase.index')}}"><i class="mdi mdi-account-multiple-plus"></i>customer</a></li>
                        </ul>
                    </li>
                    <li><a href="#"  class="has-arrow wave-effect"><i class="mdi mdi-wallet-bifold"></i><span>Expense</span></a>
                        <ul class="sub-menu mm-collapse" aria-expanded="false">
                            <li><a href="{{route('admin.purchase.index')}}"><i class="mdi mdi-calendar-account-outline"></i>Month</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
            <!-- Sidebar -->
        </div>
    </div>
    <!-- Left Sidebar End -->
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @yield('page-breadcrumb')
                @yield('content')
            </div>
        </div>
    </section>
    <footer class="footer">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-6">
                                    <script>document.write(new Date().getFullYear())</script> © Black Bull Tyres.
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-sm-end d-none d-sm-block">
                                        Crafted with <i class="mdi mdi-heart text-danger"></i> by Black Bull Tyres
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>
    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js')}}"></script>
    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <!-- Datatable init js -->
    <script src="{{ asset('assets/js/pages/datatables.init.js')}}"></script>
    <script src="{{ asset('assets/js/app.js')}}"></script>
    <script src="https://unpkg.com/izitoast/dist/js/iziToast.min.js"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <!-- File Uploaders -->
    <link rel="stylesheet" href="{{asset('assets/file-uploader/css/font-fileuploader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/file-uploader/css/script.css')}}">
    <script src="{{asset('assets/file-uploader/js/file-uploader.js')}}"></script>
    <script src="{{asset('assets/file-uploader/js/file-custom.js')}}"></script>
     <!-- include summernote css/js -->
     <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
     <!-- include Select2 css/js -->
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
     <!-- Calender Semantic date picker -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
     <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @yield('add-js')

    @if(Session::has('success'))
        <script>
            successAlert('{!! Session::get('success') !!}');
        </script>
    @endif

    @if(Session::has('error'))
        <script>
            errorAlert('{!! Session::get('error') !!}');
        </script>
    @endif
    </body>

    </html>
