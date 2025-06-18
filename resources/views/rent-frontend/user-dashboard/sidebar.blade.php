<!-- Simplicity is an acquired taste. - Katharine Gerould -->
<div class="quicktech-doctor-panel-menu">
    <a
    @if (Request::routeIs('dashboard'))
    style="background-color:#ffe000; color:black;"
    @endif
    href="{{ route('dashboard') }}">
        <img src="{{ asset('rent-frontend/images') }}/dashboard.png" alt="" /> DASHBOARD
    </a>
    <a
    @if (Request::routeIs('user.reserve.index'))
    style="background-color:#ffe000; color:black;"
    @endif
    href="{{ route('user.reserve.index') }}">
        <img src="{{ asset('rent-frontend/images') }}/deadline.png" alt="" /> BOOKING LIST
    </a>
    <a
    @if (Request::routeIs('user.wishlist.index'))
    style="background-color:#ffe000; color:black;"
    @endif
    href="{{ route('user.wishlist.index') }}">
        <img src="{{ asset('rent-frontend/images') }}/wishlist(1).png" alt="" /> WISHLIST
    </a>
    <a
    @if (Request::routeIs('profile.edit'))
    style="background-color:#ffe000; color:black;"
    @endif
    href="{{ route('profile.edit') }}">
        <img src="{{ asset('rent-frontend/images') }}/profile(1).png" alt="" /> MY PROFILE
    </a>
    <a href="{{ route('user.logout') }}"><img src="{{ asset('rent-frontend/images') }}/logout.png" alt="" /> LOGOUT</a>
</div>
