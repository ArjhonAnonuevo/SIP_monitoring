<?php
  session_start();
  // Check if the username is passed as a parameter
  if (isset($_GET["username"])) {
      $username = $_GET["username"];
  } else {
      // Check if the username is stored in the session
      if (isset($_SESSION["username"])) {
          $username = $_SESSION["username"];
      } else {
          // Handle the case when the username is not available
          $username = "Unknown"; // Set a default value
      }
  }
  ?>