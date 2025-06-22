<!-- Life is available only in the present moment. - Thich Nhat Hanh -->
<!doctype html>
<html lang="en">

<!-- Mirrored from rn53themes.net/themes/matrimo/admin/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 15 Oct 2024 05:32:52 GMT -->

<head>
    <title>Renth</title>
    <!--== META TAGS ==-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="theme-color" content="#f6af04">
    <meta name="robots" content="noindex">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <!--== FAV ICON(BROWSER TAB ICON) ==-->
    <link rel="shortcut icon" href="https://rn53themes.net/themes/matrimo/images/fav.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!--== CSS FILES ==-->
    <link rel="stylesheet" href="{{ asset('admin-backend/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-backend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-backend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-backend/css/admin-style.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- HEAD -->
    @include('backend.layouts.navbar')
    <!-- END -->
    <!-- COPYRIGHTS -->
    <section>
        <div class="main">
            <div class="incon">
                <div class="row">
                    @include('backend.layouts.sidebar')

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Warning!</strong> {{ session('warning') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    </section>
    <!-- END -->
    <!-- COPYRIGHTS -->
    <section>
        <div class="cr">
            <div class="container">
                <div class="row">
                    <p>Copyright ©
                        <a href="https://www.quicktech-ltd.com/" target="_blank">QuickTechIT</a> All
                        rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('admin-backend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin-backend/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin-backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin-backend/js/select-opt.js') }}"></script>
    <script src="{{ asset('admin-backend/js/chart.js') }}"></script>
    <script src="{{ asset('admin-backend/js/admin-custom.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#example');
    </script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            @if (session('toastr_success'))
                toastr.success("{{ session('toastr_success') }}");
            @endif

            @if (session('toastr_error'))
                toastr.error("{{ session('toastr_error') }}");
            @endif

            @if (session('toastr_warning'))
                toastr.warning("{{ session('toastr_warning') }}");
            @endif

            @if (session('toastr_info'))
                toastr.info("{{ session('toastr_info') }}");
            @endif
        });
    </script>

    @stack('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- sweetalert --}}
    <script>
        $(document).ready(function () {
            // csrf-token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('body').on('click','.delete-item', function (e) {
                e.preventDefault();
                let deleteUrl = $(this).attr('href');
                // console.log(deleteUrl);
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: deleteUrl,
                            success: function (data) {
                                if (data.status == 'error') {
                                    Swal.fire({
                                        title: "You can not Delete!",
                                        text: "This category contain items so cannot be deleted.",
                                        icon: "error"
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Your file has been deleted.",
                                        icon: "success"
                                    });
                                    window.location.reload();
                                }
                            },
                            error: function (xhr, status, error) {
                                console.log(error);
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>

<!-- Mirrored from rn53themes.net/themes/matrimo/admin/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 15 Oct 2024 05:33:26 GMT -->

</html>

