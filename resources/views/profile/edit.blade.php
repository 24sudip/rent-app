@extends('rent-frontend.frontend-dashboard')

@section('frontent_content')
<!-- user dashboard -->
<section id="quicktech-doctors-panel" style="margin-top: 56px">
    <div class="container">
        <div class="row gapp mb-5">
            <div class="col-lg-3">
                @include('rent-frontend.user-dashboard.sidebar')
            </div>
            <div class="col-lg-9">
                <div class="quicktech-doc-right-panel">
                    <h4>Account Information</h4>
                    <div class="row mt-3 gapp">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row gapp">
                                <div class="col-md-12">
                                    <div class="profile-picture-container">
                                        <img src="{{ (!empty($user->profile_photo)) ? asset($user->profile_photo) : '' }}" id="profilePreview" class="rounded-circle" alt="profile_photo"
                                        />
                                        <input
                                            type="file"
                                            id="profilePicture"
                                            name="profile_photo"
                                            class="form-control mt-2"
                                            accept="image/*"
                                            style="display: none"
                                        />
                                        <button
                                            type="button"
                                            class="btn btn-primary mt-2"
                                            onclick="document.getElementById('profilePicture').click();"
                                        >
                                            Upload Profile Picture
                                        </button>
                                        <button type="submit" style="margin-top: 6px;" class="btn btn-success quicktech-n-btn"><i class="fas fa-check"></i></button>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="card quicktech-card">
                                        <div class="card-body">
                                            <h5 class="card-title">Full name</h5>
                                            <p class="card-text display-text">
                                                {{ $user->name }}
                                                <a href="#" class="text-danger edit-toggle">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                            </p>
                                            <div class="input-group edit-input" style="display: none">
                                                <input type="text" class="form-control" name="name"
                                                value="{{ $user->name }}" />
                                                <button class="btn btn-success quicktech-n-btn" type="submit">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card quicktech-card">
                                        <div class="card-body">
                                            <h5 class="card-title">Birthday</h5>
                                            <p class="card-text display-text">
                                                {{ $user->birthday }}
                                                <a href="#" class="text-danger edit-toggle">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                            </p>
                                            <div class="input-group edit-input" style="display: none">
                                                <input type="date" class="form-control" name="birthday"
                                                value="{{ $user->birthday }}" />
                                                <button class="btn btn-success quicktech-n-btn" type="submit">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card quicktech-card">
                                        <div class="card-body">
                                            <h5 class="card-title">Gender</h5>
                                            <p class="card-text display-text">
                                                {{ $user->gender }}
                                                <a href="#" class="text-danger edit-toggle">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                            </p>
                                            <div class="input-group edit-input" style="display: none">
                                                <input type="text" class="form-control" name="gender"
                                                value="{{ $user->gender }}" />
                                                <button class="btn btn-success quicktech-n-btn" type="submit">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card quicktech-card">
                                        <div class="card-body">
                                            <h5 class="card-title">Address</h5>
                                            <p class="card-text display-text">
                                                {{ $user->address }}
                                                <a href="#" class="text-danger edit-toggle">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                            </p>
                                            <div class="input-group edit-input" style="display: none">
                                                <input type="text" name="address" value="{{ $user->address }}" class="form-control" />
                                                <button class="btn btn-success quicktech-n-btn" type="submit">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- user dashboard -->
@endsection
