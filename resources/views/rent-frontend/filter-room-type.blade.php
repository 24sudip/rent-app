<!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
@extends('rent-frontend.frontend-dashboard')

@section('frontent_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- categories -->
<section id="quicktech-categories">
    <div class="container">
        <div class="row my-5">
            <div class="col-lg-3 col-md-3 d-none d-lg-block d-md-none">
                <div class="filter-container">
                    <h5>
                        <a href="#" style="float:right; color:blue; text-decoration:none; font-size: 16px;">
                            Clear All
                        </a>
                    </h5>
                    <form action="{{ route('filter.location') }}" method="post">
                        @csrf
                        <div class="quicktech-cate-checkbox">
                            <span class="filter-title">Division</span><br>
                            <select name="division_id" id="locationSelect">
                                <option value="">Select Division</option>
                                @foreach ($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="quicktech-cate-checkbox">
                            <span class="filter-title">District</span><br>
                            <select name="district_id" id="locationSelect">
                                <option></option>
                            </select>
                        </div>
                        <br>
                        <div class="quicktech-cate-checkbox">
                            <span class="filter-title">Upazilla/Thana</span><br>
                            <select name="upazilla_id" id="locationSelect">
                                <option></option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success mt-4">Filter Location</button>
                    </form>
                    <br>
                    <form action="{{ route('filter.room-type') }}" method="post">
                        @csrf
                        <div class="quicktech-cate-checkbox">
                            <span class="filter-title">Select room sharing type</span><br>
                            <input type="radio" name="share_type" value="single" checked> Single<br>
                            <input type="radio" name="share_type" value="double"> Double<br>
                            <input type="radio" name="share_type" value="triple"> Triple<br>
                            {{-- <input type="checkbox"> Triple+<br> --}}
                            <button type="submit" class="btn btn-success mt-4">Filter Room Type</button>
                        </div>
                    </form>
                    <br>
                    <form action="{{ route('filter.resident') }}" method="post">
                        @csrf
                        <div class="quicktech-cate-checkbox">
                            <span class="filter-title">Select your gender</span><br>
                            <input type="radio" name="gender" value="Male">Male<br>
                            <input type="radio" name="gender" value="Female">Female<br>
                            <input type="radio" name="gender" value="Any" checked>Any<br>
                        </div>
                        <br>
                        <div class="quicktech-cate-checkbox">
                            <span class="filter-title">Type of residents</span><br>
                            <input type="radio" name="resident_type" value="Working professional" checked>Working professional<br>
                            <input type="radio" name="resident_type" value="Students">Students<br>
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Filter</button>
                    </form>
                    {{-- <br>
                    <div class="price-range">
                        <span class="filter-title">Select your budget</span>
                        <input type="range" class="priceRange" min="0" max="50000" step="1000" value="25000" oninput="updatePrice(this)">
                        <div class="range-labels">
                            <span>Tk 0</span>
                            <span class="priceValue">Tk 50,000</span>
                        </div>
                    </div>
                    <br>
                    <div class="quicktech-cate-checkbox">
                        <span class="filter-title">Security Deposit</span><br>
                        <input type="checkbox"> 15 days<br>
                        <input type="checkbox"> 1 Month<br>
                        <input type="checkbox"> 2 Month<br>
                        <input type="checkbox"> 3 Month<br>
                    </div> --}}
                </div>
            </div>
            <div class="col-lg-9">
                <div class="quicktech-categories-product-inner">
                    <div class="quicktech-categories-head">
                        <h6>{{ $rooms->count() }} properties found</h6>
                        <h4>Home/</h4>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-12">
                        @foreach ($rooms as $room)
                        <div class="quicktech-product-main-inner">
                            <div class="quiktech-categor-p-img">
                                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($room->property->multi_images as $key => $multi_image)
                                        <div class="carousel-item quicktech-cate {{ $key == 0 ? 'active' : '' }}">
                                            <img src="{{ asset($multi_image->photo_name) }}" class="d-block w-100" alt="...">
                                        </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                            <div class="quicktech-categories-p-details">
                                <div class="d-flex justify-content-between quicktech-wishlist">
                                    <h3>{{ $room->property->title }}</h3>
                                    <button><i class="fa-solid fa-heart"></i></button>
                                </div>
                                <span>
                                    {{ $room->property->address }}
                                </span>

                                <ul class="quicktech-offers">
                                    <li>
                                        <img src="{{ asset('rent-frontend/images') }}/bed.png" alt="">
                                        @foreach ($room->property->room_types as $room_type)
                                        <span>{{ $room_type->share_type }}, </span>
                                        @endforeach
                                    </li>
                                    <li><img src="{{ asset('rent-frontend/images') }}/gender-equality.png" alt="">
                                        {{ $room->property->gender }} Resident</li>
                                    <li><img src="{{ asset('rent-frontend/images') }}/student.png" alt="">
                                        {{ $room->property->resident_type }}</li>
                                    {{-- <li>{{ $property->division->name }}</li>
                                    <li>{{ $property->district->name }}</li>
                                    <li>{{ $property->upazila->name }}</li> --}}
                                </ul>
                                <hr>

                                <div class="quikctech-price d-flex justify-content-between align-items-center">
                                    <h6>Starts from Tk.{{ $room->property->starting_price }}</h6>
                                    <a href="propertydetails.html">I am interested</a>
                                </div>

                            </div>
                        </div>
                        <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- catgories -->


<!-- bottom filter -->
<button class="quicktech-filter d-block d-lg-none d-md-block" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Filter</button>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="filter-container">
            <h5>Filters <a href="#" style="float:right; color:blue; text-decoration:none; font-size: 16px;">Clear All</a></h5>
            <div class="quicktech-cate-checkbox">
                <span class="filter-title">Select District</span><br>
                <select name="location" id="locationSelect">
                <option value="" selected disabled>Select Division</option>
                <option value="new-york">Dhaka</option>
                <option value="los-angeles">Mohammadpur</option>
                <option value="chicago">Banani</option>
                <option value="houston">Ghulshan</option>
                </select>
            </div>
            <br>
            <div class="quicktech-cate-checkbox">
                <span class="filter-title">Select Area/Thana</span><br>
                <select name="location" id="locationSelect">
                    <option value="" selected disabled>Select Division</option>
                    <option value="new-york">Dhaka</option>
                    <option value="los-angeles">Mohammadpur</option>
                    <option value="chicago">Banani</option>
                    <option value="houston">Ghulshan</option>
                </select>
            </div>
            <br>
            <div class="quicktech-cate-checkbox">
                <span class="filter-title">Select room sharing type</span><br>
                <input type="checkbox"> Single<br>
                <input type="checkbox"> Double<br>
                <input type="checkbox"> Triple<br>
                <input type="checkbox" checked> Triple+<br>
            </div>
            <br>
            <div class="quicktech-cate-checkbox">
                <span class="filter-title">Select your gender</span><br>
                <input type="radio" name="gender"> Male<br>
                <input type="radio" name="gender"> Female<br>
                <input type="radio" name="gender"> Any<br>
            </div>
            <br>
            <div class="quicktech-cate-checkbox">
                <span class="filter-title">Type of residents</span><br>
                <input type="checkbox"> Working professional<br>
                <input type="checkbox"> Students<br>
            </div>
            <br>
            {{-- <div class="price-range">
                <span class="filter-title">Select your budget</span>
                <input type="range" class="priceRange" min="0" max="50000" step="1000" value="25000" oninput="updatePrice(this)">
                <div class="range-labels">
                    <span>Tk 0</span>
                    <span class="priceValue">Tk 50,000</span>
                </div>
            </div>
            <br>
            <div class="quicktech-cate-checkbox">
                <span class="filter-title">Security Deposit</span><br>
                <input type="checkbox"> 15 days<br>
                <input type="checkbox"> 1 Month<br>
                <input type="checkbox"> 2 Month<br>
                <input type="checkbox"> 3 Month<br>
            </div> --}}
        </div>
    </div>
</div>
<!-- bottom filter -->
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
@endsection

