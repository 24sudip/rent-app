const searchInput = document.querySelector(".search");
const suggestionsContainer = document.querySelector(".suggestions");

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
        return `<li class="list">${upazillaName}, ${districtName}</li>`;
    }).join('');
    suggestionsContainer.innerHTML = matchEl;
}
