<!-- It is never too late to be what you might have been. - George Eliot -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="{{ route('index') }}"><img src="{{ asset('rent-frontend/images') }}/logo.png" style="height: 70px;" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="#">For Property Managers</a>
        </li>

        <li class="nav-item">
          <a href="allblog.html" class="nav-link">Blog</a>
        </li>
      </ul>
      <ul class="quikctech-right-nav">
        <li><a class="nav-link quikctech-sign-up-btnn" href="listproperty.html">List your Property</a></li>
        @auth
        <li><a class="nav-link quikctech-sign-up-btn" href="{{ route('dashboard') }}">Dashboard</a></li>
        @else
        <li><a class="nav-link quikctech-sign-up-btn" href="{{ route('register') }}">Sign Up</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
