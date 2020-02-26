const filterInput = document.getElementById("filterInput");
const filterClearBtn = document.getElementById("filterClearBtn");

document.addEventListener("DOMContentLoaded", function(event) {
  registerEventListeners();
});

function registerEventListeners() {
  filterInput.addEventListener("input", filterDrops);
  filterClearBtn.addEventListener("click", filterClear);
}

function filterClear(e){
  filterInput.value = "";
  filterInput.dispatchEvent(new Event("input"));
}

function filterDrops(e) {
  const text = e.target.value.toLowerCase();
  document.querySelectorAll(".myButton").forEach(function(drop) {
    const title = drop.firstChild.textContent;
    let artist = drop.getAttribute("data-balloon");
    if (artist === null) {
      artist = "";
    }
    // Search both title and artist
    const track = title + artist;

    if (track.toLowerCase().indexOf(text) != -1) {
      drop.style.display = "inline";
    } else {
      drop.style.display = "none";
    }
  });
}
