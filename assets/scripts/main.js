// Preview image in input-forms
function preview_image(event) {
  const reader = new FileReader();
  reader.onload = function() {
    const output = document.querySelector(".output_image");
    output.src = reader.result;
  };
  reader.readAsDataURL(event.target.files[0]);
}

let menuIsOpen = false;
// Burger-animation
const navIcon = document.querySelector(".nav-icon1");
const menuSelector = document.querySelector(".mobile-menu");
navIcon.addEventListener("click", () => {
  navIcon.classList.toggle("open");
  menuSelector.classList.toggle("display");
  menuIsOpen = !menuIsOpen;
});
