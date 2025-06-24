<!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
<section id="quikctech-what">
    <div class="container">
        <div class="row mt-2">
            <div class="col-lg-12">
                <div class="quikctech-head-main text-center">
                    <h1>{{ $what_you_setting->title }}</h1>
                    <h5>{{ $what_you_setting->sub_title }}</h5>
                </div>
            </div>
        </div>
        <div class="row mb-5 mt-5">
            <div class="col-lg-5 wow slideInLeft">
                <div class="quikctech-video-call-inner">
                    @foreach ($what_you_items as $what_you_item)
                    <div style="background-color: #FFFCF3;" class="expandable-container">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $what_you_item->id }}">
                            <div class="expandable-header">
                                <span class="text-center">
                                    <img src="{{ asset($what_you_item->photo) }}" style="height: 35px;"
                                        alt="photo"> <br> <br>
                                    {{ $what_you_item->title }}
                                </span>
                            </div>
                        </a>
                    </div>
                    <br>
                    @endforeach
                    <!-- Modal -->
                    @foreach ($what_you_items as $what_you_item)
                    <div class="modal fade" id="exampleModal{{ $what_you_item->id }}" tabindex="-1" aria-labelledby="exampleModal{{ $what_you_item->id }}Label"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModal{{ $what_you_item->id }}Label">{{ $what_you_item->title }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ $what_you_item->description }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6 wow slideInRight">
                <div class="quikctech-what-video">
                    <video src="{{ asset($what_you_setting->video) }}" class="w-100" autoplay loop muted
                        playsinline></video>
                </div>
            </div>
        </div>
    </div>
</section>
