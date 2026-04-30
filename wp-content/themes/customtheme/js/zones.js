document.addEventListener("DOMContentLoaded", function () {

  const modal = document.getElementById("zone-modal");
  const closeBtn = document.getElementById("zone-close");

  // 🔥 CLICK NA CARD (funguje vždy)
  document.addEventListener("click", function(e){

    const card = e.target.closest(".zone-card");
    if(!card) return;

    const index = card.dataset.index;

    // hide all
    document.querySelectorAll(".zone-detail").forEach(d => {
      d.classList.add("hidden");
    });

    // show selected
    const active = document.querySelector(`.zone-detail[data-index="${index}"]`);
    if(active) active.classList.remove("hidden");

    modal.classList.remove("hidden");

  });

  // CLOSE
  closeBtn.addEventListener("click", () => {
    modal.classList.add("hidden");
  });

  // CLICK OUTSIDE
  modal.addEventListener("click", (e) => {
    if(e.target === modal){
      modal.classList.add("hidden");
    }
  });

  // 🔥 GALLERY FULL CONTROL
document.addEventListener("click", function(e){

  const thumb = e.target.closest(".zone-thumb");
  if(!thumb) return;

  const detail = thumb.closest(".zone-detail");
  const main = detail.querySelector(".zone-main-image");
  const thumbs = detail.querySelectorAll(".zone-thumb");

  let currentIndex = parseInt(thumb.dataset.index);

  // set main image
  main.src = thumb.dataset.full;

  // remove active
  thumbs.forEach(t => t.classList.remove("opacity-100"));
  thumbs.forEach(t => t.classList.add("opacity-60"));

  // active thumb
  thumb.classList.remove("opacity-60");
  thumb.classList.add("opacity-100");

  // uloz index
  detail.dataset.current = currentIndex;

});

  });
// 🔥 LIGHTBOX GALÉRIA
const lightbox = document.getElementById("lightbox");
const lightboxImg = document.getElementById("lightbox-img");
const closeLb = document.getElementById("lightbox-close");
const nextLb = document.getElementById("lightbox-next");
const prevLb = document.getElementById("lightbox-prev");

let currentImages = [];
let currentIndex = 0;

// OPEN
document.addEventListener("click", function(e){

  const img = e.target.closest(".zone-image");
  if(!img) return;

  const detail = img.closest(".zone-detail");

  // všetky obrázky v tejto sekcii
  const imgs = detail.querySelectorAll(".zone-image");

  currentImages = Array.from(imgs).map(i => i.dataset.full || i.src);
  currentIndex = parseInt(img.dataset.index || 0);

  lightboxImg.src = currentImages[currentIndex];
  lightbox.classList.remove("hidden");

});

// CLOSE
closeLb.addEventListener("click", () => {
  lightbox.classList.add("hidden");
});

// NEXT
nextLb.addEventListener("click", () => {
  currentIndex++;
  if(currentIndex >= currentImages.length) currentIndex = 0;
  lightboxImg.src = currentImages[currentIndex];
});

// PREV
prevLb.addEventListener("click", () => {
  currentIndex--;
  if(currentIndex < 0) currentIndex = currentImages.length - 1;
  lightboxImg.src = currentImages[currentIndex];
});

// CLICK OUTSIDE
lightbox.addEventListener("click", (e) => {
  if(e.target === lightbox){
    lightbox.classList.add("hidden");
  }
});