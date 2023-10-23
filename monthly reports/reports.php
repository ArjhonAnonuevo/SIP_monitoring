<?php
require "create table.php";
include "../dashboard/dashboard_navs.php"
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="reports.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">  
  
  <title>Montly Reports </title>

</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-md-4">
      <div class="card" style="height: 400px;">
        <div class="card-header text-center">
          <span id="nextMonth" style="font-family: 'Lato', Arial, sans-serif; font-size: 18px;"></span>
        </div>
        <div class="card-body d-flex flex-column justify-content-end margin">
          <div class="mt-auto text-center" >
            <button id="upload1" class="upload" data-bs-toggle="modal" data-bs-target="#modals">Upload</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


  <div class="modal fade" id="modals" tabindex="-1" aria-labelledby="modals" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      <div class="modal-header bg-success text-white" style="font-family: 'Lato', sans-serif; font-weight: bold;">
      <h5 class="modal-title" id="modals" style="font-size: 20px;">Upload Your monthly reports</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="submit1.php" method="POST" enctype="multipart/form-data" id = "uploadForm">
            <div class="mb-3">
              
            <label for="fileInput1" class="form-label" style="font-family: 'Lato', sans-serif; font-size: 16px;">Choose file</label>
            <input type="file" class="form-control" id="fileInput" name="file"  style="font-size: 14px;" required>
              <p id="fileName" style="margin-top: 10px;" style = "font-size: 15px"></p>
            </div> 
            <button type="submit" class="btn btn-success">Submit</button>
            <button type="button" class="btn btn-danger unsubmit" data-bs-toggle="modal" data-bs-target="#myModal">Unsubmit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="modals" aria-hidden="true">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header">			
        <h4 class="modal-title">Confirmation</h4>	
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete your account? This action cannot be undone and you will be unable to recover any data.</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-info" data-dismiss="modal">Cancel</a>
        <a href="#" class="btn btn-danger">Yes, delete it!</a>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
      // Enable Bootstrap 5 modal functionality
      var myModal = new bootstrap.Modal(document.getElementById('myModal'));
      $('.trigger-btn').click(function() {
        myModal.show();
      });
    });
  </script>
    
</body>
</html>
<script src = "reports1.js"></script>
  <!-- <script src = "reset.js"></script> -->
  <script src = "unsubmit.js"></script>