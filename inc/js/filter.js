const filterInput = document.getElementById("filterInput");

document.addEventListener("DOMContentLoaded", function(event) {
  registerEventListeners();
});

function registerEventListeners() {
  filterInput.addEventListener("keyup", filterDrops);
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
