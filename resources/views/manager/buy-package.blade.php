<!-- An unexamined life is not worth living. - Socrates -->
@extends('rent-frontend.frontend-dashboard')

@section('frontent_content')
<!-- user dashboard -->
<section id="quicktech-doctors-panel" style="margin-top: 56px">
    <div class="container">
        <div class="row gapp mb-5">
            <div class="col-lg-3">
                @include('manager.body.sidebar')
            </div>
            <div class="col-lg-9">
                <div class="quicktech-doc-right-panel">
                    <div class="row gapp">
                        @foreach ($packages as $key => $package)
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card text-center shadow-lg quicktech-premium-card">
                                <div class="card-header bg-{{ $key % 3 == 0 ? 'primary' : '' }}{{ $key % 3 == 1 ? 'success' : '' }}{{ $key % 3 == 2 ? 'warning' : '' }} text-white quicktech-premium-card-header">
                                    {{ $package->name }} Plan
                                </div>
                                <div class="card-body">
                                    <h2 class="card-title text-primary">Tk. {{ $package->price }}</h2>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">✔ {{ $package->maximum_post }} Posts</li>
                                        <li class="list-group-item">✔ {{ $package->duration }} Days</li>
                                        <li class="list-group-item">✔ {{ $package->short_description }}</li>
                                        {{-- ✖ --}}
                                    </ul>
                                    <form action="{{ route('manager.subscribe', $package->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary mt-3 quicktech-premium-btn">Subscribe</button>
                                    </form>
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
<!-- user dashboard -->
@endsection
