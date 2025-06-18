<!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
@extends('rent-frontend.frontend-dashboard')

@section('frontent_content')
<!-- property details -->
    <section id="quicktech-property-details">
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="quicktech-gallery-slide">
                        <div id="uniqueSwiper" class="custom-swiper-container swiper">
                            <div class="swiper-wrapper">
                                @foreach ($property->multi_images as $multi_image)
                                <div class="swiper-slide quicktech-propertygallery-img">
                                    <img src="{{ asset($multi_image->photo_name) }}" class="w-100 propertyimage" alt="multi_image" data-bs-toggle="modal" data-bs-target="#imageModal{{ $multi_image->id }}">
                                </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gapp mt-5 mb-5">
                <div class="col-lg-6">
                    <h3>{{ $property->title }}</h3>
                    <div class="quicktech-property-details-head">
                        <h4>About Property</h4>
                        <p>{{ $property->about_property }}</p>
                    </div>
                    <br>
                    <div class="quicktech-Property-amenities quicktech-property-details-head">
                        <h4>Property Amenities</h4>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="common-tab" data-bs-toggle="tab" data-bs-target="#common" type="button" role="tab">Common</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="room-tab" data-bs-toggle="tab" data-bs-target="#room" type="button" role="tab">Room</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="service-tab" data-bs-toggle="tab" data-bs-target="#service" type="button" role="tab">Service</button>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="myTabContent">
                            @php
                                $common_amenities = App\Models\Amenity::where('property_id', $property->id)->where('amenity_type','common')->get();
                            @endphp
                            <div class="tab-pane fade show active" id="common" role="tabpanel">
                                <ul class="quicktech-amenite-list">
                                    @foreach ($common_amenities as $amenity)
                                    <li>
                                        <img src="{{ asset('rent-frontend/images') }}/1.png" height="22px" alt="">
                                        {{ $amenity->amenity_name }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @php
                                $room_amenities = App\Models\Amenity::where('property_id', $property->id)->where('amenity_type','room')->get();
                            @endphp
                            <div class="tab-pane fade" id="room" role="tabpanel">
                                <ul class="quicktech-amenite-list">
                                    @foreach ($room_amenities as $amenity)
                                    <li>
                                        <img src="{{ asset('rent-frontend/images') }}/1.png" height="22px" alt="">
                                        {{ $amenity->amenity_name }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @php
                                $service_amenities = App\Models\Amenity::where('property_id', $property->id)->where('amenity_type','service')->get();
                            @endphp
                            <div class="tab-pane fade" id="service" role="tabpanel">
                                <ul class="quicktech-amenite-list">
                                    @foreach ($service_amenities as $amenity)
                                    <li>
                                        <img src="{{ asset('rent-frontend/images') }}/1.png" height="22px" alt="">
                                        {{ $amenity->amenity_name }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="quicktech-renting-terms quicktech-property-details-head">
                        <h4>Renting Terms</h4>
                        <div class="quicktech-rent-list mt-3">
                            @foreach ($property->rent_terms as $rent_term)
                            <p>
                                <span><img src="{{ asset('rent-frontend/images') }}/v1.webp" style="height: 20px;" alt="">{{ $rent_term->name }}</span>
                                <span>{{ $rent_term->description }}</span>
                            </p>
                            @endforeach
                        </div>
                    </div>
                    <br>
                    <div class="quicktech-renting-terms quicktech-property-details-head">
                        <h4>Rent Packages</h4>
                        <div class="quicktech-rent-list mt-3">
                            @foreach ($property->rent_packages as $rent_package)
                            <p>
                                <span>✅ {{ $rent_package->name }}</span>
                                <span>Tk. {{ $rent_package->price }}/-</span>
                            </p>
                            @endforeach
                        </div>
                    </div>
                    <br>
                    <div class="quicktech-renting-terms quicktech-property-details-head">
                        <h4>Property Rules</h4>
                        <div class="quicktech-rent-list mt-3">
                            <ul class="quicktech-rules-list">
                                @foreach ($property->property_rules as $property_rule)
                                <li>
                                    <img src="{{ asset('rent-frontend/images') }}/tick.png" style="height:23px;" alt="">
                                    {{ $property_rule->rule_name }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <br>
                    <div class="quicktech-renting-terms quicktech-property-details-head">
                        <h4>Search by location</h4>
                        <div class="quicktech-rent-listt mt-3">
                            <div class="quicktech-map-search">
                                <input type="text" placeholder="Check distance from property’s location">
                                <button class="quicktech-location-icon"><i class="fa-solid fa-location-dot"></i></button>
                                <button class="quicktech-search-icon"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                            {!! $property->map_embed_code !!}
                        </div>
                    </div>
                    <br>
                    <div class="quicktech-property-owner">
                        <div class="quicketch-property-owner-img">
                            <img src="{{ asset($property->manager->profile_photo) }}" alt="profile_photo">
                            <h6>Property Owner <br> <span style="font-weight: 700;">{{ $property->owner_name }}</span></h6>
                        </div>
                    </div>
                    <div class="quikctech-property-owner-message">
                        <p id="text"
                            style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;margin: 0;">
                            {{ $property->about_owner }}
                        </p>
                        <span id="toggleBtn" style="color: blue; cursor: pointer; font-weight: bold; display: inline-block; margin-top: 5px;" onclick="toggleText()">See More</span>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="quicktech-available-room-inner">
                        <div class="quicktech-availabe-rooms">
                            <h4>Available Rooms</h4>
                        </div>
                        <ul class="nav nav-tabs" id="sharingTab" role="tablist">
                            @foreach ($property->rooms as $key => $room)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $key == 0 ? 'active' : '' }}" id="{{ $room->share_type }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $room->share_type }}" type="button" role="tab">
                                    {{ $room->share_type }} Sharing
                                </button>
                            </li>
                            @endforeach
                        </ul>
                        <div class="tab-content mt-3" id="sharingTabContent">
                            <!-- Single Sharing Tab -->
                            @foreach ($property->rooms as $key => $room)
                            <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="{{ $room->share_type }}" role="tabpanel">
                                <div class="quicktech-single-sharing-inner">
                                    <div class="quikctech-single-sharing-top">
                                        <h5 class="quicktech-starts">
                                            <img src="{{ asset('rent-frontend/images') }}/ss.png" style="height: 40px;" alt="">{{ $room->share_type }} sharing
                                        </h5>
                                        <h5 class="quicktech-starts">
                                            Starts from <span class="quicktech-rent-price">Tk. {{ $room->price }} / Room</span>
                                        </h5>
                                    </div>
                                    <div class="quicktech-single-middle mt-3 mb-4">
                                        <ul>
                                            @foreach ($room->property->amenities as $amenity)
                                            <li>
                                                <img src="{{ asset('rent-frontend/images') }}/1.png" style="height: 30px;" alt="img">
                                                {{ $amenity->amenity_name }}
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="quicktech-single-bottom">
                                        <h6>{{ $room->tenant }} Tenants staying</h6>
                                        <!-- Button to trigger modal -->
                                        @auth
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reserveModal">
                                            Reserve Now
                                        </button>
                                        @else
                                        <a class="btn btn-primary" href="{{ route('login') }}">
                                            Login To Reserve
                                        </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
<!-- property details -->



<!-- image modal -->

<!-- Modal -->
@foreach ($property->multi_images as $multi_image)
<div class="modal fade" id="imageModal{{ $multi_image->id }}" tabindex="-1" aria-labelledby="imageModal{{ $multi_image->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered quicktech-modal-dialog">
        <div class="modal-content quicktech-modal-content">
            <div class="modal-body quicktech-modal-img text-center">
                <img id="modalImage" src="{{ $multi_image->photo_name }}" alt="multi_image">
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- image modal -->


<!-- Bootstrap Modal -->
<div class="modal fade" id="reserveModal" tabindex="-1" aria-labelledby="reserveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reserveModalLabel">Reserve Your Bed</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Please fill out the details to proceed with your reservation.</p>
                <form method="POST" action="{{ route('user.reserve.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullName" placeholder="Enter your name" name="fullName" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" value="{{ auth()->user()->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" placeholder="Enter your phone number" name="phone" value="{{ auth()->user()->phone }}">
                    </div>
                    <div class="mb-3">
                        <label for="sharingType" class="form-label">Sharing Type</label>
                        <select class="form-control" id="sharingType" name="sharingType">
                            <option>Select</option>
                            @foreach ($property->rooms as $room)
                            <option>{{ $room->share_type }} Sharing</option>
                            @endforeach
                        </select>
                    </div>
                  <div class="mb-3">
                      <label for="date" class="form-label">Select Date</label>
                      <input type="date" class="form-control" id="date" name="date">
                  </div>
                  <div class="mb-3">
                      <label for="time" class="form-label">Select Time</label>
                      <input type="time" class="form-control" id="time" name="time">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Confirm Reservation</button>
                  </div>
              </form>

              
            </div>
        </div>
    </div>
</div>
@endsection
