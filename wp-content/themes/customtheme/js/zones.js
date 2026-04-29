document.addEventListener("DOMContentLoaded", function () {

    const cards = document.querySelectorAll(".zone-card");
    const modal = document.getElementById("zone-modal");
    const closeBtn = document.getElementById("zone-close");
    const details = document.querySelectorAll(".zone-detail");
  
    cards.forEach(card => {
      card.addEventListener("click", () => {
  
        const index = card.getAttribute("data-index");
  
        // hide all
        details.forEach(d => d.classList.add("hidden"));
  
        // show selected
        const active = document.querySelector(`.zone-detail[data-index="${index}"]`);
        if(active) active.classList.remove("hidden");
  
        modal.classList.remove("hidden");
      });
    });
  
    closeBtn.addEventListener("click", () => {
      modal.classList.add("hidden");
    });
  
    // klik mimo
    modal.addEventListener("click", (e) => {
      if(e.target === modal){
        modal.classList.add("hidden");
      }
    });
  
  });