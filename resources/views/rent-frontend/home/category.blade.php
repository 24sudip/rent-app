<!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
<section id="quicktech-properties">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="quikctech-head-main text-center">
                    <h1>Bangladesh's Largest network of App-enabled Properties</h1>
                    <h5>5000+ Properties & 1 Lacs+ Tenants </h5>
                </div>
            </div>
        </div>
        <div class="row gapp mt-5 mb-5 wow bounceInUp">
            <div class="col-lg-1"></div>
            @foreach ($property_categories as $property_category)
            <div class="col-lg-2 col-sm-4 col-4">
                <a href="{{ route('category.properties', $property_category->id) }}">
                    <div class="quikctech-properties-inner text-center">
                        <img src="{{ asset($property_category->category_photo) }}" class="w-100" alt="category_photo">
                        <h4>{{ $property_category->name }}</h4>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
