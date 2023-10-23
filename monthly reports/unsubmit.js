document.querySelector('.unsubmit').addEventListener('click', function() {
  $('#myModal').modal('show');
});

document.querySelector('.modal-footer .btn-danger').addEventListener('click', function() {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'unsubmit.php', true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      window.location.href = "reports.php";
    }
  };
  xhr.send();
});
  