<!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
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
                                    <h2 class="mb-4">Property Edit</h2>
                                    <form method="POST" action="{{ route('manager.property.room.update', $property->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <h5>Available Rooms*</h5>
                                        <div class="mb-3 quicktech-available-rooms">
                                            <input type="checkbox" id="single" class="room-check" name="single" value="single" checked> Single Sharing
                                            <div id="single-fields" class="mt-2">
                                                @if ($single)
                                                <input type="number" placeholder="Single sharing price" class="form-control mb-2" name="single_price" step="0.01" value="{{ $single->price }}">
                                                <input type="number" placeholder="Number of Tenants" class="form-control" name="single_tenant" value="{{ $single->tenant }}">
                                                @else
                                                <input type="number" placeholder="Single sharing price" class="form-control mb-2" name="single_price" step="0.01">
                                                <input type="number" placeholder="Number of Tenants" class="form-control" name="single_tenant">
                                                @endif
                                            </div>
                                            <br>
                                            <input type="checkbox" id="double" class="room-check" name="double" value="double" checked> Double Sharing
                                            <div id="double-fields" class="mt-2">
                                                @if ($double)
                                                <input type="number" placeholder="Double sharing Price" class="form-control mb-2" name="double_price" step="0.01" value="{{ $double->price }}">
                                                <input type="number" placeholder="Number of Tenants" class="form-control" name="double_tenant" value="{{ $double->tenant }}">
                                                @else
                                                <input type="number" placeholder="Double sharing Price" class="form-control mb-2" name="double_price" step="0.01">
                                                <input type="number" placeholder="Number of Tenants" class="form-control" name="double_tenant">
                                                @endif
                                            </div>
                                            <br>
                                            <input type="checkbox" id="triple" class="room-check" name="triple" value="triple" checked> Triple Sharing
                                            <div id="triple-fields" class="mt-2">
                                                @if ($triple)
                                                <input type="number" placeholder="Price" class="form-control mb-2" name="triple_price" step="0.01" value="{{ $triple->price }}">
                                                <input type="number" placeholder="Number of Tenants" class="form-control" name="triple_tenant" value="{{ $triple->tenant }}">
                                                @else
                                                <input type="number" placeholder="Price" class="form-control mb-2" name="triple_price" step="0.01">
                                                <input type="number" placeholder="Number of Tenants" class="form-control" name="triple_tenant">
                                                @endif
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success mb-2">Update</button>
                                    </form>

                                    <h5>Property Amenities*</h5>
                                    <div class="mb-3 quicktech-available-rooms">
                                        <form method="POST" action="{{ route('manager.property.common.update', $property->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="checkbox" id="common" class="common-check" name="common_check" value="common"> common
                                            @if ($commons)
                                            <div id="common-fields" class="mt-2">
                                                @foreach ($commons as $common)
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control form-control-solid
                                                    @error('commons.0') is-invalid @enderror
                                                    " name="commons[]" value="{{ $common->amenity_name }}">
                                                    <button type="button" class="btn btn-primary add-more">+</button>
                                                </div>
                                                @endforeach
                                            </div>
                                            @else
                                            <div id="common-fields" class="mt-2">
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="commons[]">
                                                    <button type="button" class="btn btn-primary add-more">+</button>
                                                </div>
                                            </div>
                                            @endif
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </form>
                                        <br>
                                        <form method="POST" action="{{ route('manager.property.amenity.update', $property->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="checkbox" id="room" class="amenity-check" name="room_check" value="room"> room
                                            @if ($rooms)
                                            <div id="room-fields" class="mt-2">
                                                @foreach ($rooms as $room)
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="rooms[]" value="{{ $room->amenity_name }}">
                                                    <button type="button" class="btn btn-primary add-more">+</button>
                                                </div>
                                                @endforeach
                                            </div>
                                            @else
                                            <div id="room-fields" class="mt-2">
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="rooms[]">
                                                    <button type="button" class="btn btn-primary add-more">+</button>
                                                </div>
                                            </div>
                                            @endif
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </form>
                                        <br>
                                        <form method="POST" action="{{ route('manager.property.service.update', $property->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="checkbox" id="service" class="service-check" name="service_check" value="service"> service
                                            @if ($services)
                                            <div id="service-fields" class="mt-2">
                                                @foreach ($services as $service)
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="services[]" value="{{ $service->amenity_name }}">
                                                    <button type="button" class="btn btn-primary add-more">+</button>
                                                </div>
                                                @endforeach
                                            </div>
                                            @else
                                            <div id="service-fields" class="mt-2">
                                                <div class="input-group mb-2">
                                                    <input type="text" class="form-control" name="services[]">
                                                    <button type="button" class="btn btn-primary add-more">+</button>
                                                </div>
                                            </div>
                                            @endif
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </form>
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
                                    <form method="POST" action="{{ route('manager.property.rent-package.update', $property->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div id="rent-package">
                                            @foreach ($property->rent_packages as $rent_package)
                                            <div class="input-group mb-2">
                                                <input type="text" placeholder="Name" class="form-control"
                                                name="package_names[]" value="{{ $rent_package->name }}">
                                                <input type="number" placeholder="Price" class="form-control"
                                                name="package_prices[]" step="0.01" value="{{ $rent_package->price }}">
                                                <button type="button" class="btn btn-primary add-more">+</button>
                                            </div>
                                            @endforeach
                                        </div>
                                        <button type="submit" class="btn btn-success mb-2">Update</button>
                                    </form>

                                    <h5>Rent Terms*</h5>
                                    <form method="POST" action="{{ route('manager.property.rent-term.update', $property->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div id="rent-terms">
                                            @foreach ($property->rent_terms as $rent_term)
                                            <div class="input-group mb-2">
                                                <input type="text" placeholder="Term Name" class="form-control" name="term_names[]" value="{{ $rent_term->name }}">
                                                <input type="text" placeholder="Description" class="form-control" name="term_descriptions[]" value="{{ $rent_term->description }}">
                                                <button type="button" class="btn btn-primary add-more">+</button>
                                            </div>
                                            @endforeach
                                        </div>
                                        <button type="submit" class="btn btn-success mb-2">Update</button>
                                    </form>

                                    <h5>Property Rules*</h5>
                                    <form method="POST" action="{{ route('manager.property.rules.update', $property->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div id="property-rules">
                                            @foreach ($property->property_rules as $property_rule)
                                            <div class="input-group mb-2">
                                                <input type="text" placeholder="Rule" class="form-control" name="rules[]" value="{{ $property_rule->rule_name }}">
                                                <button type="button" class="btn btn-primary add-more">+</button>
                                            </div>
                                            @endforeach
                                        </div>
                                        <button type="submit" class="btn btn-success mb-2">Update</button>
                                    </form>

                                    <form method="POST" action="{{ route('manager.property.update', $property->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label class="form-label">Title*</label>
                                            <input type="text" class="form-control" placeholder="Enter Title" name="title" value="{{ $property->title }}">
                                            @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">About*</label>
                                            <textarea class="form-control" placeholder="Enter About"
                                            name="about_property">{{ $property->about_property }}</textarea>
                                            @error('about_property')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="quicktech-cate-checkbox">
                                            <span class="filter-title">Select Division</span><br>
                                            <select name="division_id" id="locationSelect">
                                                <option value="">Select Division</option>
                                                @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}" {{ $property->division_id == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
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
                                                <option value="{{ $property->district_id }}">{{ $property->district->name }}</option>
                                            </select>
                                            @error('district_id')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <br>
                                        <div class="quicktech-cate-checkbox">
                                            <span class="filter-title">Select Upzilla/Thana</span><br>
                                            <select name="upazilla_id" id="locationSelect">
                                                <option value="{{ $property->upazilla_id }}">{{ $property->upazila->name }}</option>
                                            </select>
                                            @error('upazilla_id')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <br>
                                        <div class="mb-3">
                                            <label class="form-label">Property Owner Name*</label>
                                            <input type="text" class="form-control" placeholder="Enter property owner name" name="owner_name" value="{{ $property->owner_name }}">
                                            @error('owner_name')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">About Property Owner</label>
                                            <textarea class="form-control" name="about_owner">{{ $property->about_owner }}</textarea>
                                            @error('about_owner')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-success mb-2">Update</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-12 border pt-2 mt-2">
                                <h5>Edit Multi Image</h5>
                                <form method="POST" action="{{ route('manager.multi-image.update') }}"
                                 enctype="multipart/form-data">
                                    @csrf
                                    <table class="table table-bordered table-striped mt-4">
                                        <thead>
                                            <tr>
                                                <th scope="col">SL</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Change Image</th>
                                                <th scope="col" width="40%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($property->multi_images as $multi_image)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td><img src="{{ asset($multi_image->photo_name) }}" width="80"></td>
                                                <td>
                                                    <input type="file" name="multi_img[{{ $multi_image->id }}]" class="form-group" id="multiImg">
                                                </td>
                                                <td width="40%">
                                                    <input type="submit" class="btn btn-primary px-2" value="Update Image">
                                                    <a href="{{ route('manager.multi-image.delete', $multi_image->id) }}" class="btn btn-danger" id="delete">Delete</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- <div class="mb-3">
                                        <div class="row" id="preview_img"></div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Update</button> --}}
                                </form>
                                <form method="POST" action="{{ route('manager.multi-image.store') }}"
                                 enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                                    <table class="table table-bordered table-striped mt-4">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="file" name="multi_img" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="submit" class="btn btn-info px-2" value="Add Image">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
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
    {{-- <script>
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
  </script> --}}
@endsection
