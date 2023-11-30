document.addEventListener("DOMContentLoaded", function() {
  const formPages = document.querySelectorAll(".form-page");
  const nextButtons = document.querySelectorAll(".next-page");
  const prevButtons = document.querySelectorAll(".prev-page");

  let currentPage = 0;

  nextButtons.forEach((button, index) => {
    button.addEventListener("click", function() {
      formPages[currentPage].style.display = "none";
      currentPage = index + 1;
      formPages[currentPage].style.display = "block";
    });
  });
  
  prevButtons.forEach((button, index) => {
    button.addEventListener("click", function() {
      formPages[currentPage].style.display = "none";
      currentPage = index - 1;
      formPages[currentPage].style.display = "block";
    });
  });
});
