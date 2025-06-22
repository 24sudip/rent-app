<!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
@extends('rent-frontend.frontend-dashboard')

@section('frontent_content')
<!-- user dashboard -->
    <section id="quicktech-doctors-panel" style="margin-top:56px;">
        <div class="container">
           <div class="row gapp mb-5">
                <div class="col-lg-3">
                    @include('manager.body.sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="quicktech-doc-right-panel">
                        <div class="row gapp">
                            <div class="col-lg-6 col-md-6">
                                <div class="quicktech-doc-dash">
                                    <div class="quicktech-dash-text">
                                        <h3>Total Rent Active</h3>
                                        <p>{{ $active_property }}</p>
                                    </div>
                                    <div class="quikctech-dash-img">
                                        <img src="{{ asset('rent-frontend/images') }}/rent.png" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="quicktech-doc-dash">
                                    <div class="quicktech-dash-text">
                                        <h3>Total Rent Pending</h3>
                                        <p>{{ $pending_property }}</p>
                                    </div>
                                    <div class="quikctech-dash-img">
                                        <img src="{{ asset('rent-frontend/images') }}/insurance.png" alt="" />
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
