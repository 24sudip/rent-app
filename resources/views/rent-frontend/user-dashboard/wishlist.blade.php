<!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
@extends('rent-frontend.frontend-dashboard')

@section('frontent_content')
<!-- user dashboard -->
<section id="quicktech-doctors-panel" style="margin-top:56px;">
    <div class="container">
       <div class="row gapp mb-5">
            <div class="col-lg-3">
                @include('rent-frontend.user-dashboard.sidebar')
            </div>
            <div class="col-lg-9">
                <div class="quicktech-doc-right-panel">
                    @foreach ($wishlists as $wishlist)
                    <div class="quicktech-product-main-inner">
                        <div class="quiktech-categor-p-img">
                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($wishlist->property->multi_images as $key => $multi_image)
                                    <div class="carousel-item quicktech-cate {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset($multi_image->photo_name) }}" class="d-block w-100" alt="multi_image">
                                    </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="quicktech-categories-p-details">
                            <div class="d-flex justify-content-between quicktech-wishlist">
                                <h3>{{ $wishlist->property->title }}</h3>
                            </div>
                            <span>
                                {{ $wishlist->property->address }}
                            </span>
                            <ul class="quicktech-offers">
                                <li>
                                    <img src="{{ asset('rent-frontend/images') }}/bed.png" alt="">
                                    @foreach ($wishlist->property->rooms as $room)
                                    <span>{{ $room->share_type }}, </span>
                                    @endforeach
                                </li>
                                <li><img src="{{ asset('rent-frontend/images') }}/gender-equality.png" alt="">
                                    {{ $wishlist->property->gender }} Resident
                                </li>
                                <li><img src="{{ asset('rent-frontend/images') }}/student.png" alt="">{{ $wishlist->property->resident_type }}</li>
                            </ul>
                            <hr>

                            <div class="quikctech-price d-flex justify-content-between align-items-center">
                                <h6>
                                    <form action="{{ route('user.wishlist.destroy', $wishlist->id) }}" method="post">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-danger btn-sm" onclick="return(confirm('Are you sure you want to delete this item?'))">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </h6>
                                <a href="{{ route('property.details', $wishlist->property_id) }}">View</a>
                            </div>

                        </div>
                    </div>
                    <br>
                    @endforeach
                </div>
            </div>
       </div>
    </div>
</section>
<!-- user dashboard -->
@endsection
