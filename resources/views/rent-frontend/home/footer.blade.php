<!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->
 <section id="quicktech-footer">
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="quicktech-footer-logo">
          <img src="{{ asset('rent-frontend/images') }}/logo.png" alt="">
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="quicktech-footer-menu mt-3">
          <ul style=" padding-left: 20px;">
            <h5>Quick Links</h5>
            <li><a href="#">Home</a></li>
            <li><a href="#">Blog</a></li>
            @auth
                @if (auth()->user()->role == 'user')
                <li><a href="{{ route('dashboard') }}"> User dashboard</a></li>
                @elseif (auth()->user()->role == 'manager')
                <li><a href="{{ route('manager.dashboard') }}"> Manager dashboard</a></li>
                @endif
            @else
            <li><a href="{{ route('login') }}">User Login</a></li>
            <li><a href="{{ route('manager.login') }}">Manager Login</a></li>
            <li><a href="{{ route('manager.register') }}">Manager Registration</a></li>
            @endauth
          </ul>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="quicktech-footer-menu mt-3">
          <ul>
            <h5>Subscribe to our newsletter</h5>
            <div class="quikctech-subs-input">
              <input type="text" placeholder="Enter Your Email">
              <button>Subscribe</button>
            </div>
          </ul>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="quicktech-footer-menu mt-3">
          <ul>
            <h5>Contact</h5>
              <li><i class="fa-solid fa-location-dot"></i> Address: Mirpur 10</li>
              <li><a href="tel:018888888"><i class="fa-solid fa-phone"></i> Phone: 01777777777 </a></li>
              <li><a href="mailto:demo@gmail.com"><i class="fa-solid fa-envelope"></i> Email: demo@gmail.com </a></li>
          </ul>
          <div class="quicktech-map mt-3">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d29203.683394670963!2d90.3807302!3d23.8022212!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1740909147441!5m2!1sen!2sbd" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-5">
      <div class="col-lg-12">
        <div class="quicktech-copyright text-center">
          <img src="{{ asset('rent-frontend/images') }}/ssl.png" alt="">
          <p>© 2025 Renth | All rights reserved | Designed & Developed by <a href="https://www.quicktech-ltd.com/">QuickTech IT</a>
          </p>
        </div>
      </div>
    </div>
  </div>
 </section>
