<!-- He who is contented is rich. - Laozi -->
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
                                    <h2 class="mb-4">Property Post</h2>
                                    <form method="POST" action="{{ route('manager.property.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Title*</label>
                                            <input type="text" class="form-control" placeholder="Enter Title" name="title">
                                            @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">About*</label>
                                            <textarea class="form-control" placeholder="Enter About" name="about_property"></textarea>
                                            @error('about_property')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <h5>Available Rooms*</h5>
                                        <div class="mb-3 quicktech-available-rooms">
                                            <input type="checkbox" id="single" class="room-check" name="single" value="single"> Single Sharing
                                            <div id="single-fields" class="d-none mt-2">
                                                <input type="number" placeholder="Single sharing price" class="form-control mb-2" name="single_price" step="0.01">
                                                <input type="number" placeholder="Number of Tenants" class="form-control" name="single_tenant">
                                            </div>
                                            <br>
                                            <input type="checkbox" id="double" class="room-check" name="double" value="double"> Double Sharing
                                            <div id="double-fields" class="d-none mt-2">
                                                <input type="number" placeholder="Double sharing Price" class="form-control mb-2" name="double_price" step="0.01">
                                                <input type="number" placeholder="Number of Tenants" class="form-control" name="double_tenant">
                                            </div>
                                            <br>
                                            <input type="checkbox" id="triple" class="room-check" name="triple" value="triple"> Triple Sharing
                                            <div id="triple-fields" class="d-none mt-2">
                                                <input type="number" placeholder="Price" class="form-control mb-2" name="triple_price" step="0.01">
                                                <input type="number" placeholder="Number of Tenants" class="form-control" name="triple_tenant">
                                            </div>
                                        </div>

                                        <h5>Property Amenities*</h5>
                                        <div class="mb-3 quicktech-available-rooms">
                                            <input type="checkbox" id="common" class="amenity-check" name="common_check" value="common"> common
                                            <div id="common-fields" class="d-none mt-2">
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="commons[]">
                                                    <button type="button" class="btn btn-primary add-more">+</button>
                                                </div>
                                            </div>
                                            <br>
                                            <input type="checkbox" id="room" class="amenity-check" name="room_check" value="room"> room
                                            <div id="room-fields" class="d-none mt-2">
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="rooms[]">
                                                    <button type="button" class="btn btn-primary add-more">+</button>
                                                </div>
                                            </div>
                                            <br>
                                            <input type="checkbox" id="service" class="amenity-check" name="service_check" value="service"> service
                                            <div id="service-fields" class="d-none mt-2">
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="services[]">
                                                    <button type="button" class="btn btn-primary add-more">+</button>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="mb-3" id="amenities">
                                            <input type="checkbox" class="amenity-check" data-type="common"> Common
                                            <div class="amenity-fields d-none mt-2" id="common-fields"></div>
                                            <br>
                                            <input type="checkbox" class="amenity-check" data-type="room"> Room
                                            <div class="amenity-fields d-none mt-2" id="room-fields"></div>
                                            <br>
                                            <input type="checkbox" class="amenity-check" data-type="service"> Service
                                            <div class="amenity-fields d-none mt-2" id="service-fields"></div>
                                        </div> --}}

                                        <h5>Rent Package*</h5>
                                        <div id="rent-package">
                                            <div class="input-group mb-2">
                                                <input type="text" placeholder="Name" class="form-control"
                                                name="package_names[]">
                                                <input type="number" placeholder="Price" class="form-control"
                                                name="package_prices[]" step="0.01">
                                                <button type="button" class="btn btn-primary add-more">+</button>
                                            </div>
                                        </div>

                                        <h5>Rent Terms*</h5>
                                        <div id="rent-terms">
                                            <div class="input-group mb-2">
                                                <input type="text" placeholder="Term Name" class="form-control" name="term_names[]">
                                                <input type="text" placeholder="Description" class="form-control" name="term_descriptions[]">
                                                <button type="button" class="btn btn-primary add-more">+</button>
                                            </div>
                                        </div>

                                        <h5>Property Rules*</h5>
                                        <div id="property-rules">
                                            <div class="input-group mb-2">
                                                <input type="text" placeholder="Rule" class="form-control" name="rules[]">
                                                <button type="button" class="btn btn-primary add-more">+</button>
                                            </div>
                                        </div>

                                        <div class="quicktech-cate-checkbox">
                                            <span class="filter-title">Select Division</span><br>
                                            <select name="division_id" id="locationSelect">
                                                <option value="">Select Division</option>
                                                @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('division_id')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <br>
                                        <div class="quicktech-cate-checkbox">
                                            <span class="filter-title">Select District</span><br>
                                            <select name="district_id" id="locationSelect">
                                                <option></option>
                                            </select>
                                            @error('district_id')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <br>
                                        <div class="quicktech-cate-checkbox">
                                            <span class="filter-title">Select Upzilla/Thana</span><br>
                                            <select name="upazilla_id" id="locationSelect">
                                                <option></option>
                                            </select>
                                            @error('upazilla_id')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <br>
                                        <div class="mb-3">
                                            <label class="form-label">Residents Gender*</label>
                                            <select class="form-control" name="gender">
                                                <option value="">Select</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Any">Any</option>
                                            </select>
                                            @error('gender')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Residents Type*</label>
                                            <select class="form-control" name="resident_type">
                                                <option value="">Select</option>
                                                <option value="Working professional">Working professional</option>
                                                <option value="Students">Students</option>
                                            </select>
                                            @error('resident_type')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Address*</label>
                                            <input type="text" class="form-control" placeholder="Enter Address" name="address">
                                            @error('address')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Starting Price</label>
                                            <input type="number" class="form-control" placeholder="Enter Starting Price" name="starting_price" step="0.01">
                                            @error('starting_price') 
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Property Owner Name*</label>
                                            <input type="text" class="form-control" placeholder="Enter property owner name" name="owner_name">
                                            @error('owner_name')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">About Property Owner</label>
                                            <textarea class="form-control" name="about_owner"></textarea>
                                            @error('about_owner')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <h5>Upload Images*</h5>
                                        <div class="mb-3">
                                            <input type="file" name="multi_img[]" class="form-control" id="multiImg" multiple>
                                            <div class="row" id="preview_img"></div>
                                        </div>

                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </section>
    <!-- user dashboard -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('select[name="district_id"]').on('change', function () {
                var district_id = $(this).val();
                if (district_id) {
                    $.ajax({
                        url: "{{ url('/upazilla/ajax') }}/"+district_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="upazilla_id"]').html('');
                            var d_two = $('select[name="upazilla_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="upazilla_id"]').append(
                                    '<option value="'+ value.id + '">' + value.name +'</option>'
                                );
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('select[name="division_id"]').on('change', function () {
                var division_id = $(this).val();
                if (division_id) {
                    $.ajax({
                        url: "{{ url('/district/ajax') }}/"+division_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="district_id"]').html('');
                            var d = $('select[name="district_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="district_id"]').append(
                                    '<option value="'+ value.id + '">' + value.name +'</option>'
                                );
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $('#multiImg').on('change', function(){ //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function(index, file){ //loop though each file
                    if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file){ //trigger function on successful read
                        return function(e) {
                            var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                            ; //create image element
                            //.height(80)
                            $('#preview_img').append(img); //append image to output element
                        };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            }else{
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });
  </script>
@endsection
