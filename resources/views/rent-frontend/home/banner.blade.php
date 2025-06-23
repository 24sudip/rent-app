<!-- Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead -->
<style>
    * {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

/* body {
  font-family: Arial, Helvetica, sans-serif;
} */

input {
  width: 100%;
  padding: 20px;
}

.search-form {
  max-width: 400px;
  margin: 50px auto;
}

input.search {
  margin: 0;
  text-align: center;
  outline: none;
  border: none;
  width: 120%;
  left: -10%;
  position: relative;
  top: 10px;
  z-index: 2;
  border-radius: 5px;
  font-size: 25px;
  box-shadow: 0 0 5px 5px rgba(0, 0, 0, 0.12);
}

.suggestions {
  margin-top: 15px;
  height: 300px;
  overflow: auto;
}

.suggestions li {
  background: white;
  list-style: none;
  border-bottom: 1px solid #d8d8d8;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.14);
  margin: 0;
  padding: 20px;
}

.highlight {
  background: #7700ff;
  color: white;
}

</style>
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
                    <form action="{{ route('search.location') }}" method="post" enctype="multipart/form-data" class="search-form">
                        @csrf
                        <div class="quikctech-search-box">
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" class="search" placeholder="Enter a location" name="location">
                            <input type="hidden" name="category_id" id="category_id">
                            <button type="submit" class="quikctech-search-btn">Search</button>
                        </div>
                        <ul class="suggestions">

                        </ul>
                    </form>
                </div>
            </div>
            <div class="quicktech-text-bann text-center mt-2">
                <p>82000+ millennials staying happily in over 4100+ properties</p>
            </div>
        </div>
    </div>
</section>

<script>
const searchInput = document.querySelector(".search");
const suggestionsContainer = document.querySelector(".suggestions");
const url = "{{ url('/') }}";

searchInput.addEventListener('change', displayMatches);
searchInput.addEventListener('keyup', displayMatches);

const upzillasDistricts = [];
fetch("{{ url('/') }}/upzillas/districts")
    .then((response) => response.json())
    .then((responseData) => {
        upzillasDistricts.push(...responseData);
    });
function findMatches(wordToMatch, upzillasDistricts) {
    return upzillasDistricts.filter((upzillaDistrict) => {
        const regX = new RegExp(wordToMatch, "gi");
        return upzillaDistrict.name.match(regX) || upzillaDistrict.district.name.match(regX);
    });
}
function displayMatches() {
    const findArray = findMatches(this.value, upzillasDistricts);
    const matchEl = findArray.map((place) => {
        const regX = new RegExp(this.value, 'gi');
        const upazillaName = place.name.replace(
            regX,
            `<span class="highlight">${this.value}</span>`
        );
        const districtName = place.district.name.replace(
            regX,
            `<span class="highlight">${this.value}</span>`
        );
        const quikctech_selected = document.querySelector('.quikctech-selected');
        const category_id = document.querySelector('#category_id');
        category_id.value = quikctech_selected.children[2].value;
        return `<li class="list">
            <a href="${url}/property-category/${category_id.value}/upazilla/${place.id}">
                ${upazillaName}, ${districtName}
            </a>
        </li>`;
    }).join('');
    suggestionsContainer.innerHTML = matchEl;
}
// if (quikctech_selected != null) {
// }
</script>
