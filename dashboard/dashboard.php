<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
     .neu-card {
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -ms-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.4);
    }

    .neu-card:hover {
        -webkit-transform: scale(1.05);
        -moz-transform: scale(1.05);
        -ms-transform: scale(1.05);
        -o-transform: scale(1.05);
        transform: scale(1.05);
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.5);
    }
    .neu-card {
    background: #e0e0e0; 
    border-radius: 15px; 
    box-shadow:  20px 20px 60px #bebebe, 
                 -20px -20px 60px #ffffff;
}
.btn-sea-green {
    background-color: #2E8B57 !important;
    color: white !important;
    border-radius:15px;
}
    </style>
</head>
<body>
<?php include "dashboard_navs.php"; ?>

<div class="container my-5">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="neu-card">
        <img src="../css/attendance.jpg" class="card-img-top" alt="Image 1">
        <div class="card-body">
          <h5 class="card-title">Attendance</h5>
          <p class="card-text">Click to view attendance records.</p>
          <a href="attendance.php" class="btn btn-success btn-sea-green">View</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mx-auto">
      <div class="neu-card">
        <img src="../css/reports.jpg" class="card-img-top" alt="Image 2">
        <div class="card-body">
          <h5 class="card-title">Monthly Reports</h5>
          <p class="card-text">Click to view monthly reports.</p>
          <a href="../monthly reports/reports.php" class="btn btn-success btn-sea-green">View</a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mx-auto">
      <div class="neu-card">
        <img src="../css/certifications.jpg" class="card-img-top" alt="Image 3">
        <div class="card-body">
          <h5 class="card-title">Certifications</h5>
          <p class="card-text">Click to view certifications.</p>
          <a href="../tailwind_configs/src/index.php" class="btn btn-success btn-sea-green">View</a>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<script src="navs.js"></script>
<?php include "interns_calendar.php"; ?>
</body>
</html>
