<!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
@extends('rent-frontend.frontend-dashboard')

@section('frontent_content')
<!-- register -->
  <section id="quikctech-register">
    <div class="container">
      <div class="row my-5">
        <div class="col-lg-6 m-auto">
            <div class="quikctech-container">
               <div class="quicktech-regis-head text-center">
                    <img style="height: 100px;" src="{{ asset('rent-frontend/images') }}/logo.png" alt="">
                    <h4>Manager Sign Up</h4>
               </div>
                <form method="POST" action="{{ route('manager.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="quikctech-form-group">
                        <label for="name" class="quikctech-label">Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" autofocus autocomplete="name" class="quikctech-input" required>
                        @if ($errors->has('name'))
                        <p class="text-danger">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="quikctech-form-group">
                        <label for="email" class="quikctech-label">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="username" class="quikctech-input" required>
                        @if ($errors->has('email'))
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="quikctech-form-group">
                        <label for="phone" class="quikctech-label">Phone</label>
                        <input type="tel" id="phone" name="phone" class="quikctech-input" required>
                        @if ($errors->has('phone'))
                        <p class="text-danger">{{ $errors->first('phone') }}</p>
                        @endif
                    </div>
                    {{-- <div class="quikctech-form-group">
                        <label for="gender" class="quikctech-label">Gender</label>
                        <select id="gender" name="gender" class="quikctech-select" required>
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        @if ($errors->has('gender'))
                        <p class="text-danger">{{ $errors->first('gender') }}</p>
                        @endif
                    </div>
                    <div class="quikctech-form-group">
                        <label for="role" class="quikctech-label">Role Or Type</label>
                        <select id="role" name="type" class="quikctech-select" required>
                            <option value="">Select role</option>
                            <option value="house-owner">House owner</option>
                            <option value="hostel-owner">Hostel owner</option>
                            <option value="hotel-owner">Hotel owner</option>
                            <option value="for-rent">For rent</option>
                        </select>
                        @if ($errors->has('type'))
                        <p class="text-danger">{{ $errors->first('type') }}</p>
                        @endif
                    </div> --}}
                    <div class="quikctech-form-group">
                      <label for="role" class="quikctech-label">Type Or Category</label>
                      <select id="role" name="property_category_id" class="quikctech-select" required>
                          <option value="">Select Type</option>
                          @foreach ($property_categories as $property_category)
                          <option value="{{ $property_category->id }}">{{ $property_category->name }}</option>
                          @endforeach
                      </select>
                  </div>
                    <div class="quikctech-form-group">
                        <label for="password" class="quikctech-label">Password</label>
                        <input type="password" id="password" name="password" class="quikctech-input" autocomplete="new-password" required>
                        @if ($errors->has('password'))
                        <p class="text-danger">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div class="quikctech-form-group">
                        <label for="password_confirmation" class="quikctech-label">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" class="quikctech-input" required>
                        @if ($errors->has('password_confirmation'))
                        <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                        @endif
                    </div>
                    <div class="quikctech-form-group">
                        <label for="profile-pic" class="quikctech-label">Profile Picture</label>
                        <input type="file" id="profile-pic" name="profile_photo" accept="image/*" class="quikctech-input">
                    </div>
                    <button type="submit" class="quikctech-btn">Register</button>
                     <br>
                     <br>
                    <p>Already Have an account <a href="{{ route('manager.login') }}">Login As Manager now</a></p>
                </form>
            </div>
        </div>
      </div>
    </div>
  </section>
<!-- register -->
@endsection

