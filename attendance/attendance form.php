<?php
include "db config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Form</title>
    <!-- Include Tailwind CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> -->
          <link href=" ../css/dist/tailwind.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Istok+Web">
    <style>
        /* Add CSS to un-mirror the video feed */
        #reader video {
            transform: scaleX(-1);
            width: 100%; /* Make the video feed responsive */
            height: auto;
        }

        #reader {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; 
            position: relative;

        }

        @media (max-width: 768px) {
        #reader {
            height: 60vh; 
            width: auto;
            display: flex;
            justify-content: center;
            align-items: center;

        }
        #reader video{
            margin: auto;
            height: auto;
            width: 100vh;
        }
        #qr-shaded-region{
            display: block; 
        }
        #reader__dashboard_section_csr{
            position: absolute;
            top: 80%;
            left: 0;
            width: 100%;
        }
    }       
    </style>
</head>
<body>
<?php
include "../dashboard/dashboard_navs.php";
?>
    <div id="reader"></div>

    <?php
    include "attendance table.php";
    ?>

    <!-- Include the HTML5 QR Code Scanner library -->
    <script src="node_modules/html5-qrcode/html5-qrcode.min.js"></script>
    <script>
        const qrCodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 350 });
        
        qrCodeScanner.render(onScanSuccess, onScanError);

        function onScanSuccess(qrCodeMessage) {
            console.log("QR Code decoded. Message =", qrCodeMessage);
            displayScannedData(qrCodeMessage);
        }

        function onScanError(error) {
            console.error("Error processing QR code:", error);
        }

        function displayScannedData(data) {
            window.location.href = "qr read.php?data=" + encodeURIComponent(data);
        }
    </script>

    <!-- Include Bootstrap JS and jQuery (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.tailwindcss.com/2.2.19/tailwind.min.js"></script>
</body>
</html>
