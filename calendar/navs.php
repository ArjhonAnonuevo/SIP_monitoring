<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Side Navigation Bar</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
  <link rel="stylesheet" href="navs.css">
</head>
<body>
<nav class="navbar navbar-expand-lg">
  <div id="mysidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="sidebar-header">
        <img src="sec.png" alt="Logo">
      </div>
    <a href="../calendar/interns_calendar.php"> <i class="fa fa-dashboard"></i>Dashboard</a>
    <a href="#"> <i class="fa fa-clock-o" aria-hidden="true"></i>Attendace</a>
    <a href="/SIP/monthly reports\reports.php"> <i class="fa fa-tasks" aria-hidden="true"></i>Montly reports</a>
    <a href="#"><i class="fa fa-certificate" aria-hidden="true"></i>Certifications</a>
    <div class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="\SIP\interns account\profile.php">Profile</a>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </div>
  </div>
  <div id="main">
    <span id="menu" onclick="openNav()">&#9776;</span>
  </div>



</nav>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
  <script src="navs.js"></script>
</body>
</html>
