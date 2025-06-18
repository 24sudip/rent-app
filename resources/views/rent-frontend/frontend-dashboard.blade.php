<!-- Simplicity is an acquired taste. - Katharine Gerould -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Renth</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('rent-frontend/css') }}/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('rent-frontend/css') }}/slick.css">
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <link rel="stylesheet" href="{{ asset('rent-frontend/css') }}/colorfulTab.min.css">
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
    <link rel="stylesheet" href="{{ asset('rent-frontend/css') }}/all.min.css">
    <link rel="stylesheet" href="{{ asset('rent-frontend/css') }}/animate.css">
    <link rel="stylesheet" href="{{ asset('rent-frontend/css') }}/venobox.css">
    <link rel="stylesheet" href="{{ asset('rent-frontend/css') }}/style.css">
    <link rel="stylesheet" href="{{ asset('rent-frontend/css') }}/responsive.css">
    {{-- Toastr css --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
</head>
<body>

<!-- navbar -->
@include('rent-frontend.home.header')
<!-- navbar -->

@yield('frontent_content')

<!-- footer -->
@include('rent-frontend.home.footer')
<!-- footer -->

    <script src="{{ asset('rent-frontend/js') }}/jquery-1.12.4.min.js"></script>
    <script src="{{ asset('rent-frontend/js') }}/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('rent-frontend/js') }}/particles.min.js"></script>
    <script src="{{ asset('rent-frontend/js') }}/particles.js"></script>
    <script src="{{ asset('rent-frontend/js') }}/colorfulTab.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('rent-frontend/js') }}/waypoint.js"></script>
    <script src="{{ asset('rent-frontend/js') }}/jquery.counterup.js"></script>
    <script src="{{ asset('rent-frontend/js') }}/wow.min.js"></script>
    <script src="{{ asset('rent-frontend/js') }}/slick.min.js"></script>
    <script src="{{ asset('rent-frontend/js') }}/venobox.min.js"></script>
    <script src="{{ asset('rent-frontend/js') }}/custom.js"></script>

    <script>
    new WOW().init();
    </script>

    <script>
      $('.c-main').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        speed:500,
        nextArrow:".next",
        prevArrow:".prev",
        responsive: [
        {
            breakpoint: 991.98,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 3,
                speed:500,
                arrows:false,
                dots:false
            }
        },
        {
            breakpoint: 766.98,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 3,
                speed:500,
                arrows:false,
                dots:false
            }
        },
        {
            breakpoint:  575.98,
            settings: {
                infinite: true,
                slidesToShow: 2,
                slidesToScroll: 2,
                speed:500,
                arrows:false,
                dots:false
            }
        }]
    });
    </script>
    <script>
    $('.c-mainn').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        speed:500,
        nextArrow:".nextt",
        prevArrow:".prevv",
        responsive: [
        {
            breakpoint: 991.98,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 3,
                speed:500,
                arrows:false,
                dots:false
            }
        },
        {
            breakpoint: 766.98,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 3,
                speed:500,
                arrows:false,
                dots:false
            }
        },
        {
            breakpoint:  575.98,
            settings: {
                infinite: true,
                slidesToShow: 2,
                slidesToScroll: 2,
                speed:500,
                arrows:false,
                dots:false
            }
        }]
    });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const customSwiper = new Swiper('#custom-slider', {
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    320: { slidesPerView: 1, spaceBetween: 10 },
                    768: { slidesPerView: 2, spaceBetween: 20 },
                    1024: { slidesPerView: 3, spaceBetween: 30 },
                }
            });
        });
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const categories = document.querySelectorAll(".quicktech-cat-one");

        categories.forEach((category) => {
            category.addEventListener("click", function () {
            // Remove active class from all
            categories.forEach((item) => item.classList.remove("active"));

            // Add active class to clicked one
            this.classList.add("active");
            });
        });
    });
    </script>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        let options = document.querySelectorAll(".quikctech-option");
        options.forEach((option, index) => {
          setTimeout(() => {
            option.classList.add("show");
          }, index * 1000); // Delay each by 1 second
        });
      });
    </script>


    <script>
      var options = {
          strings: ["Home", "Hotel"],
          typeSpeed: 100,
          backSpeed: 50,
          loop: true
      };

      var typed = new Typed("#changingText", options);
    </script>

<script>
  var options = {
      strings: ["Home", "Hotel"],
      typeSpeed: 100,
      backSpeed: 50,
      loop: true
  };

  var typed = new Typed("#rentchangingtext", options);
</script>

 <script>
    function selectOption(element) {
        document.querySelectorAll('.quikctech-option').forEach(option => option.classList.remove('quikctech-selected'));
        element.classList.add('quikctech-selected');
        var quikctech_selected = document.querySelector('.quikctech-selected');
        var category_id = document.querySelector('#category_id');
        category_id.value = quikctech_selected.children[2].value;
    }
</script>

<script>
  function toggleExpandable(element) {
      element.classList.toggle("open");
  }
</script>

<script>
  const swiper = new Swiper('.swiper', {
    direction: 'horizontal',
    loop: true,
    autoplay: {
      delay: 3000, // Auto slide every 3 seconds
      disableOnInteraction: false, // Keep autoplay active after user interaction
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true, // Allows users to click on pagination dots
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    scrollbar: {
      el: '.swiper-scrollbar',
      draggable: true, // Allows dragging the scrollbar
    },
    breakpoints: {
      320: { // Small screens (mobile)
        slidesPerView: 1,
        spaceBetween: 10,
      },
      768: { // Tablets
        slidesPerView: 2,
        spaceBetween: 20,
      },
      1024: { // Laptops & desktops
        slidesPerView: 3,
        spaceBetween: 30,
      },
    },
  });
  </script>

  <script>
    function updatePrice(slider) {
        let priceValue = slider.closest('.price-range').querySelector('.priceValue');
        priceValue.textContent = "Tk " + slider.value;
    }
</script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
      let carousels = document.querySelectorAll(".carousel");

      carousels.forEach((carousel, index) => {
          let uniqueId = "carousel-" + index;
          carousel.setAttribute("id", uniqueId);

          let prevButton = carousel.querySelector(".carousel-control-prev");
          let nextButton = carousel.querySelector(".carousel-control-next");

          if (prevButton) prevButton.setAttribute("data-bs-target", "#" + uniqueId);
          if (nextButton) nextButton.setAttribute("data-bs-target", "#" + uniqueId);
      });
  });
</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const editToggles = document.querySelectorAll(".edit-toggle");

    editToggles.forEach(function (toggle) {
      toggle.addEventListener("click", function (e) {
        e.preventDefault();
        const cardBody = this.closest(".card-body");
        cardBody.querySelector(".display-text").style.display = "none";
        cardBody.querySelector(".edit-input").style.display = "flex";
      });
    });
  });
</script>
<script>
  document.getElementById('profilePicture').addEventListener('change', function (event) {
    const reader = new FileReader();
    reader.onload = function () {
      document.getElementById('profilePreview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  });
</script>

<script>
  $(document).ready(function () {
      $('.room-check, .amenity-check').prop('checked', false);

      $('.room-check').change(function () {
          let target = `#${this.id}-fields`;
          $(target).toggleClass('d-none', !this.checked);
      });

      $('.common-check').change(function () {
          let target = `#${this.id}-fields`;
          $(target).toggleClass('d-none', !this.checked);
      });
      $('.service-check').change(function () {
          let target = `#${this.id}-fields`;
          $(target).toggleClass('d-none', !this.checked);
      });
      $('.amenity-check').change(function () {
          let target = `#${this.id}-fields`;
          $(target).toggleClass('d-none', !this.checked);
      });

    //   $('.amenity-check').change(function () {
    //       let type = $(this).data('type');
    //       let field = `#${type}-fields`;
    //       if (this.checked) {
    //           $(field).html('<div class="input-group mb-2"><input type="text" class="form-control"><button type="button" class="btn btn-primary add-more">+</button></div>');
    //           $(field).removeClass('d-none');
    //       } else {
    //           $(field).addClass('d-none').empty();
    //       }
    //   });

      $(document).on('click', '.add-more', function () {
          let parent = $(this).closest('.input-group');
          let newInput = parent.clone();
          newInput.find('input').val('');
          parent.after(newInput);
      });
  });
</script>
{{-- Toastr js --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break;
 }
 @endif
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('rent-frontend/js/mycode.js') }}"></script>
<script>
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>
<script type="text/javascript">
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content'),
        },
    });
    // Add to wishlist
    function addToWishlist(property_id) {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/add-to-wishList/"+property_id,
            success: function (data) {
                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    })
                } else {
                Toast.fire({
                    type: 'error',
                    icon: 'error',
                    title: data.error,
                    })
                }
                // End Message
            },
            // contentType: "application/json; charset=utf-8",
            // data: "data",
        });
    }
</script>
</body>
</html>
