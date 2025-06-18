<!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
<div class="quicktech-doctor-panel-menu">
    <a
    @if (Request::routeIs('manager.dashboard'))
    style="background-color:#ffe000; color:black;"
    @endif
    href="{{ route('manager.dashboard') }}">
        <img src="{{ asset('rent-frontend/images') }}/dashboard.png" alt="" /> DASHBOARD
    </a>
    <a
    @if (Request::routeIs('manager.property.create'))
    style="background-color:#ffe000; color:black;"
    @endif
    href="{{ route('manager.property.create') }}">
        <img src="{{ asset('rent-frontend/images') }}/deadline.png" alt="" />Post Property
    </a>
    <a
    @if (Request::routeIs('manager.property.index'))
    style="background-color:#ffe000; color:black;"
    @endif
    href="{{ route('manager.property.index') }}"><img src="{{ asset('rent-frontend/images') }}/deadline.png" alt="" />
        Property List
    </a>
    <a
    @if (Request::routeIs('manager.buy.package'))
    style="background-color:#ffe000; color:black;"
    @endif
    href="{{ route('manager.buy.package') }}"><img src="{{ asset('rent-frontend/images') }}/crown.png" alt="" />
        All Package
    </a>
    <a
    @if (Request::routeIs('manager.profile'))
    style="background-color:#ffe000; color:black;"
    @endif
    href="{{ route('manager.profile') }}">
        <img src="{{ asset('rent-frontend/images') }}/profile(1).png" alt="" /> MY PROFILE
    </a>
    <a href="{{ route('manager.logout') }}"><img src="{{ asset('rent-frontend/images') }}/logout.png" alt="" /> LOGOUT</a>
</div>

