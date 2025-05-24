<!-- It is never too late to be what you might have been. - George Eliot -->
@extends('rent-frontend.frontend-dashboard')

@section('frontent_content')
<!-- login -->
  <section id="quikctech-register">
    <div class="container">
      <div class="row my-5">
        <div class="col-lg-6 m-auto">
            <div class="quikctech-container">
               <div class="quicktech-regis-head text-center">
                <img style="height: 100px;" src="{{ asset('rent-frontend/images') }}/logo.png" alt="">
                <h4>Manager Login</h4>
               </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="quikctech-form-group">
                        <label for="login" class="quikctech-label">Phone</label>
                        <input type="tel" id="login" name="login" value="{{ old('login') }}" required autofocus autocomplete="username" class="quikctech-input">
                        @if ($errors->has('login'))
                        <p class="text-danger">{{ $errors->first('login') }}</p>
                        @endif
                    </div>

                    <div class="quikctech-form-group">
                        <label for="password" class="quikctech-label">Password</label>
                        <input type="password" id="password" name="password" class="quikctech-input" required autocomplete="current-password">
                        @if ($errors->has('password'))
                        <p class="text-danger">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <button type="submit" class="quikctech-btn">Login</button>
                    <br>
                    <br>
                   <p>Don't Have an account? <a href="{{ route('manager.register') }}">Register As Manager now</a></p>
                </form>
            </div>
        </div>
      </div>
    </div>
  </section>
<!-- login -->
@endsection

