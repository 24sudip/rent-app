<!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
<section id="quikctech-what">
  <div class="container">
    <div class="row mt-2">
      <div class="col-lg-12">
        <div class="quikctech-head-main text-center">
          <h1>What you see is What you get</h1>
          <h5>Real-time info from 34245 tenants in 4342 properties  </h5>
        </div>
      </div>
    </div>
    <div class="row mb-5 mt-5">
      <div class="col-lg-5 wow slideInLeft">
        <div class="quikctech-video-call-inner">
          <div style="background-color: #FFFCF3;" class="expandable-container">
            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <div class="expandable-header">
                    <span class="text-center">
                        <img src="{{ asset('rent-frontend/images') }}/v1.png" style="height: 35px;" alt=""> <br> <br>
                        Real time availability
                    </span>
                </div>
            </a>
        </div>
        <br>
        <div style="background-color: #FFFCF3;" class="expandable-container">
          <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <div class="expandable-header">
                  <span class="text-center">
                      <img src="{{ asset('rent-frontend/images') }}/v1.png" style="height: 35px;" alt=""> <br> <br>
                      Real time availability
                  </span>
              </div>
          </a>
      </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Real time availability</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        This is the description inside the modal.
                    </div>
                </div>
            </div>
        </div>
        <br>
        <!-- <div  style="background-color: #FAF7FF;" id="videoTourCard" class="expandable-container" onclick="toggleExpandable(this)">
          <div class="expandable-header">
              <span class="text-center">
                <img src="{{ asset('rent-frontend/images') }}/v2.png" style="height: 35px;" alt=""> <br> <br>
                Live video tour</span>

          </div>
          <div class="expandable-content">
              <p>We respect your time. Pick a date & time at your convenience.</p>

          </div>
      </div>
      <br>
      <div style="background-color: #F0FFF7;" id="videoTourCard" class="expandable-container" onclick="toggleExpandable(this)">
        <div class="expandable-header">
            <span class="text-center">
              <img src="{{ asset('rent-frontend/images') }}/v3.png" style="height: 35px;" alt=""> <br> <br>
              Real Tenant Reviews</span>

        </div>
        <div class="expandable-content">
            <p>We respect your time. Pick a date & time at your convenience.</p>
        </div>
    </div> -->


        </div>
      </div>
      <div class="col-lg-6 wow slideInRight">
        <div class="quikctech-what-video">
          <video src="{{ asset('rent-frontend/images') }}/live-video-call.webm" class="w-100" autoplay loop muted playsinline></video>

        </div>
      </div>
    </div>
  </div>
</section>
