document.addEventListener("DOMContentLoaded", function() {
  const formPages = document.querySelectorAll(".form-page");
  const nextButtons = document.querySelectorAll(".next-page");
  const prevButtons = document.querySelectorAll(".prev-page");

  formPages.forEach((page, index) => {
    if (index !== 0) {
      page.style.display = "none";
    }
  });

  let currentPageIndex = 0;

  nextButtons.forEach(button => {
    button.addEventListener("click", function() {
      if (currentPageIndex < formPages.length - 1) {
        formPages[currentPageIndex].style.display = "none";
        currentPageIndex++;
        formPages[currentPageIndex].style.display = "block";
      }
    });
  });

  prevButtons.forEach(button => {
    button.addEventListener("click", function() {
      if (currentPageIndex > 0) {
        formPages[currentPageIndex].style.display = "none";
        currentPageIndex--;
        formPages[currentPageIndex].style.display = "block";
      }
    });
  });
});


var modal = document.getElementById("myModal");

var acceptBtn = document.getElementById("accept");
var declineBtn = document.getElementById("decline");

window.onload = function() {
  modal.style.display = "block";
}

acceptBtn.onclick = function() {
  modal.style.display = "none";

}

declineBtn.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}