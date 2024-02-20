function goToNextPage() {
  // Hide the current page by adding the 'hidden' class
  document.getElementById('page1').classList.add('hidden');
  // Show the next page by removing the 'hidden' class
  document.getElementById('page2').classList.remove('hidden');
}

  var modal = document.getElementById("myModal");
  var acceptBtn = document.getElementById("accept");

  // Check if modal and acceptBtn exist
  if (modal && acceptBtn) {
    // Show the modal on load
    window.onload = function() {
      modal.style.display = "block";
    };

    // Hide the modal when the accept button is clicked
    acceptBtn.onclick = function(event) {
      event.preventDefault(); // Prevent any default action
      modal.style.display = "none";
    };

    // Hide the modal when clicking outside of it
    modal.addEventListener('click', function(event) {
      if (event.target === this) {
        modal.style.display = "none";
      }
    }, false);
  };
