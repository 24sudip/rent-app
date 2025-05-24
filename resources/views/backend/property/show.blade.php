<!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
@extends('rent-frontend.frontend-dashboard')

@section('frontent_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- user dashboard -->
    <section id="quicktech-doctors-panel" style="margin-top:56px;">
        <div class="container">
           <div class="row gapp mb-5">
                <div class="col-lg-3">
                    @include('manager.body.sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="quicktech-doc-right-panel">
                        <div class="row">
                            <div class="col-lg-9 m-auto">
                                <div class="quicktech-post-form">
                                    <h2 class="mb-4">Property Details</h2>
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" value="{{ $property->title }}" readonly name="title">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">About*</label>
                                        <textarea class="form-control" name="about_property" readonly>{{ $property->about_property }}</textarea>

                                    </div>

                                    <h5>Available Rooms*</h5>
                                    <div class="mb-3 quicktech-available-rooms">
                                        @foreach ($property->rooms as $room)
                                        <b>
                                            {{ $room->share_type }} Sharing
                                        </b>
                                        <div id="{{ $room->share_type }}-fields" class="mt-2">
                                            <label for="">Price</label>
                                            <input type="number" value="{{ $room->price }}" class="form-control mb-2" name="single_price" step="0.01" readonly>
                                            <label for="">Tenant</label>
                                            <input type="number" value="{{ $room->tenant }}" class="form-control" name="single_tenant" readonly>
                                        </div>
                                        @endforeach
                                    </div>
                                    <h5>Property Amenities*</h5>
                                    <div class="mb-3 quicktech-available-rooms">
                                        common
                                        <div id="common-fields" class="mt-2">
                                            @foreach ($commons as $amenity)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" value="{{ $amenity->amenity_name }}" readonly>
                                            </div>
                                            @endforeach
                                        </div>
                                        room
                                        <div id="room-fields" class="mt-2">
                                            @foreach ($rooms as $amenity)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" value="{{ $amenity->amenity_name }}" readonly>
                                            </div>
                                            @endforeach
                                        </div>
                                        service
                                        <div id="service-fields" class="mt-2">
                                            @foreach ($services as $amenity)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" value="{{ $amenity->amenity_name }}" readonly>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <h5>Rent Package*</h5>
                                    <div id="rent-package">
                                        @foreach ($property->rent_packages as $rent_package)
                                        <div class="input-group mb-2">
                                            <input type="text" value="{{ $rent_package->name }}" class="form-control"
                                            name="package_names[]" readonly>
                                            <input type="number" value="{{ $rent_package->price }}" class="form-control"
                                            name="package_prices[]" step="0.01" readonly>
                                        </div>
                                        @endforeach
                                    </div>

                                    <h5>Rent Terms*</h5>
                                    <div id="rent-terms">
                                        @foreach ($property->rent_terms as $rent_term)
                                        <div class="input-group mb-2">
                                            <input type="text" value="{{ $rent_term->name }}" class="form-control" name="term_names[]" readonly>
                                            <input type="text" value="{{ $rent_term->description }}" class="form-control" name="term_descriptions[]" readonly>
                                        </div>
                                        @endforeach
                                    </div>

                                    <h5>Property Rules*</h5>
                                    <div id="property-rules">
                                        @foreach ($property->property_rules as $property_rule)
                                        <div class="input-group mb-2">
                                            <input type="text" value="{{ $property_rule->rule_name }}" class="form-control" name="rules[]" readonly>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="quicktech-cate-checkbox">
                                        <span class="filter-title">Division</span><br>
                                        <select name="division_id" id="locationSelect">
                                            <option value="">{{ $property->division->name }}</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="quicktech-cate-checkbox">
                                        <span class="filter-title">District</span><br>
                                        <select name="district_id" id="locationSelect">
                                            <option>{{ $property->district->name }}</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="quicktech-cate-checkbox">
                                        <span class="filter-title">Upzilla/Thana</span><br>
                                        <select name="upazilla_id" id="locationSelect">
                                            <option>{{ $property->upazila->name }}</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="mb-3">
                                        <label class="form-label">Property Owner Name</label>
                                        <input type="text" class="form-control" value="{{ $property->owner_name }}" name="owner_name" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">About Property Owner</label>
                                        <textarea class="form-control" readonly
                                        name="about_owner">{{ $property->about_owner }}</textarea>
                                    </div>

                                    <h5>Property Images*</h5>
                                    <div class="mb-3">
                                        <div class="row" id="preview_img">
                                            @foreach ($property->multi_images as $multi_image)
                                            <div class="col-lg-3">
                                                <img src="{{ asset($multi_image->photo_name) }}" class="w-100">
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </section>
    <!-- user dashboard -->
@endsection

