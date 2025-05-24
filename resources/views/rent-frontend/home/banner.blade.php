<!-- Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead -->
<section style="background: url({{ asset('rent-frontend/images') }}/banner.webp) no-repeat center / cover;" id="quicktech-banner">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="quikctech-banner-content-inner">
                    <div class="quicktech-banner-main text-center">
                        <h1>Find your <span id="changingText"></span></h1>
                        <h4>Wherever you want. Whenever you need.</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-7 m-auto quikctech-border wow slideInLeft">
                <div class="quicktech-im-inner">
                    <div class="quikctech-options d-flex">
                        @foreach ($property_categories as $key => $property_category)
                        <div class="quikctech-option" onclick="selectOption(this)">
                            <img src="{{ asset($property_category->category_photo) }}" alt="{{ $property_category->name }}">
                            <span>{{ $property_category->name }}</span>
                            <input type="hidden" name="property_category_id" value="{{ $property_category->id }}">
                        </div>
                        @endforeach
                        {{-- {{ $key == 0 ? 'quikctech-selected' : '' }} --}}
                    </div>
                </div>
                <div class="quikctech-searchh">
                    <div class="quikctech-find-text">
                        <p>Finding in</p>
                    </div>
                    <form action="{{ route('search.location') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="quikctech-search-box">
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" placeholder="Enter a location" name="location">
                            <input type="hidden" name="category_id" id="category_id">
                            <button type="submit" class="quikctech-search-btn">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="quicktech-text-bann text-center mt-2">
                <p>82000+ millennials staying happily in over 4100+ properties</p>
            </div>
        </div>
    </div>
</section>
