@extends('frontend.layouts.master')

@section('content')
    <section>
        <div class="db">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        <div class="db-nav">
                            {{-- guard('user')-> --}}
                            <div class="db-nav-pro"><img src="{{ asset(Auth::user()->profile->image) }}" class="img-fluid"
                                    alt=""></div>
                            <div class="db-nav-list">
                                <ul>
                                    <li>
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="{{ request()->routeIs('admin.dashboard') ? 'act' : '' }}">
                                            <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        {{-- 'user.profile' --}}
                                        <a href="{{ route('admin.package.index') }}"
                                            class="{{ request()->routeIs('admin.package.index') ? 'act' : '' }}">
                                            <i class="fa fa-male" aria-hidden="true"></i> Package
                                        </a>
                                    </li>
                                    <li>
                                        {{-- 'user.invitations' --}}
                                        <a href="{{ route('admin.property-category.index') }}"
                                            class="{{ request()->routeIs('admin.property-category.index') ? 'act' : '' }}">
                                            <i class="fa fa-handshake-o" aria-hidden="true"></i>Property Category
                                        </a>
                                    </li>
                                    {{-- 'user.chat.list' --}}
                                    <li><a href="{{ route('admin.property-status.index') }}" class="{{ request()->routeIs('admin.property-status.index') ? 'act' : '' }}"><i class="fa fa-commenting-o" aria-hidden="true"></i>Property List</a></li>
                                    {{-- 'user.plan' --}}
                                    <li><a href="{{ route('admin.package-order.index') }}" class="{{ request()->
                                    routeIs('admin.package-order.index') ? 'act' : '' }}"><i class="fa fa-money" aria-hidden="true"></i>Package Order</a></li>
                                    {{-- 'user.setting' --}}
                                    <li><a href="{{ route('admin.payment-package.list') }}" class="{{ request()->routeIs('admin.payment-package.list') ? 'act' : '' }}"><i class="fa fa-cog" aria-hidden="true"></i>Package Payment</a></li>
                                    <li>
                                        <a href="{{ route('admin.reserve-property.list') }}"
                                            class="{{ request()->routeIs('admin.reserve-property.list') ? 'act' : '' }}">
                                            <i class="fa fa-tachometer" aria-hidden="true"></i> Reserved Property
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.district.index') }}"
                                            class="{{ request()->routeIs('admin.district.index') ? 'act' : '' }}">
                                            <i class="fa fa-male" aria-hidden="true"></i> Districts
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.upazila.index') }}"
                                            class="{{ request()->routeIs('admin.upazila.index') ? 'act' : '' }}">
                                            <i class="fa fa-handshake-o" aria-hidden="true"></i>Upazila
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.what-you-setting.edit') }}"
                                        class="{{ request()->routeIs('admin.what-you-setting.edit') ? 'act' : '' }}">
                                            <i class="fa fa-commenting-o" aria-hidden="true"></i>What You Setting
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.what-you-item.index') }}"
                                            class="{{ request()->routeIs('admin.what-you-item.*') ? 'act' : '' }}">
                                            <i class="fa fa-money" aria-hidden="true"></i>What You Items
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.reward.index') }}"
                                            class="{{ request()->routeIs('admin.reward.*') ? 'act' : '' }}">
                                            <i class="fa fa-money" aria-hidden="true"></i>Rewards 
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i>Log out</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @yield('user_content')
                </div>
            </div>
        </div>
    </section>

    @push('script')
        <script src="{{ asset('frontend/js/Chart.js') }}"></script>

        <script>
            //COMMON SLIDER
            $('.slider').slick({
                infinite: false,
                slidesToShow: 5,
                arrows: false,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                dots: false,
                responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        centerMode: false
                    }
                }]

            });

            $('.count').each(function() {
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 4000,
                    easing: 'swing',
                    step: function(now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });

            var xValues = "0";
            var yValues = "50";

            new Chart("Chart_leads", {
                type: "line",
                data: {
                    labels: xValues,
                    datasets: [{
                        fill: false,
                        lineTension: 0,
                        backgroundColor: "#f1bb51",
                        borderColor: "#fae9c8",
                        data: yValues
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: 100
                            }
                        }]
                    }
                }
            });
        </script>
        @stack('user-script')
    @endpush

@endsection
