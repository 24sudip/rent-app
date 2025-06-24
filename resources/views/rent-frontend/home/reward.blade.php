<!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
<section id="quicktech-rewards">
    <div class="container">
        <div class="row wow bounceInUp">
            <div class="col-lg-12">
                <div class="quikctech-head-main text-center">
                    <h1>Exclusive rewards on Monthly Rent Payments</h1>
                    <h5>Exclusive Rewards, cashback, subscriptions, Insurance and discounts </h5>
                </div>
            </div>
        </div>
        <div class="row mb-5 mt-5">
            <div class="col-lg-12">
                <!-- Slider main container -->
                <div class="swiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        @foreach ($rewards as $reward)
                        <div class="swiper-slide">
                            <div class="quicktech-return-inner">
                                <div style="background: url(./{{ asset('rent-frontend/images') }}/r1.webp) no-repeat center / cover; width: 100%; height: 220px; margin-top: 30px;"
                                    class="quicktech-return-product">
                                    <div class="quicktech-reward-img text-center">
                                        <img src="{{ asset($reward->photo) }}" alt="photo">
                                    </div>
                                    <div class="quicktech-reward-text">
                                        <h5>{{ $reward->title }}</h5>
                                        <p>{{ $reward->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- If we need scrollbar -->
                    <div class="swiper-scrollbar"></div>
                </div>
            </div>
        </div>
    </div>
</section>
