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
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link href="../learning/src/output.css" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" integrity="sha256-x8PYmLKD83R9T/sYmJn1j3is/chhJdySyhet/JuHnfY=" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        html,
        body {
            font-family: "Rubik", sans-serif;
        }

        /* navigation - show navigation always on the large screen devices with (min-width:1024) */
        @media (min-width: 1024px) {
            .top-navbar {
                display: inline-flex !important;
            }
        }

        /* Adjust dropdown menu position */
        .relative {
            position: relative;
        }

        .absolute.right-0 {
            right: 0;
        }
    </style>
</head>
<body>
<nav class="flex items-center bg-green-600 p-2 flex-wrap">
    <a href="#" class="p-2 mr-auto inline-flex items-center">
        <img src="sec.png" alt="New Logo" class="h-3vh w-20 mr-2">
    </a>
    <div class="relative ml-auto">
        <button class="flex items-center text-white px-4 py-2 rounded focus:outline-none">
            <i class="material-icons mr-2">person</i>
            <span class="mr-2"><?php echo $username; ?></span>
            <i class="material-icons">arrow_drop_down</i>
        </button>
        <ul class="absolute mt-2 bg-gray-800 border border-gray-600 hidden right-0">
            <li>
                <a href="../profile/picture.php" class="block px-4 py-2 text-white hover:bg-green-600 flex items-center hover:no-underline ">
                    <i class="material-icons">account_circle</i> <!-- Profile icon -->
                    <span class="ml-2">Profile</span>
                </a>
            </li>
            <li>
                <a href="logout.php" class="block px-4 py-2 text-white hover:bg-green-600 flex items-center hover:no-underline">
                    <i class="material-icons">exit_to_app</i> <!-- Logout icon -->
                    <span class="ml-2">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $(".nav-toggler").each(function(_, navToggler) {
            var target = $(navToggler).data("target");
            $(navToggler).on("click", function() {
                $(target).animate({
                    height: "toggle"
                });
            });
        });
        $(".relative").click(function() {
            $(this).find("ul").toggleClass("hidden");
        });
    });
</script>
</body>
</html>
