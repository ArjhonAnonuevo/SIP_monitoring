<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <style>
      /* Add CSS to un-mirror the video feed */
      #reader video {
        transform: scaleX(-1);
      }
      /* Style for displaying the scanned data */
      #scanned-data {
        margin-top: 10px;
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 5px;
        font-size: 18px;
      }
    </style>
  </head>
  <body>
    <div class="container mx-auto bg-hgr">
      <h1>QR Code Scanner</h1>
      <div id="scanned-data"></div>
      <div class="container mx-auto">
        <div id="reader" class="w- sm:w-1/2 md:w-1/3 lg:w-1/2 xl:w-1/3"></div>
      </div>
      <!-- <script src="node_modules/html5-qrcode/html5-qrcode.min.js"></script> -->
      <script src="https://unpkg.com/html5-qrcode"></script>
      <script>
        const qrCodeScanner = new Html5QrcodeScanner("reader", {
          fps: 10,
          qrbox: 350
        });

        qrCodeScanner.render(onScanSuccess, onScanError);

        function onScanSuccess(qrCodeMessage) {
          console.log("QR Code decoded. Message =", qrCodeMessage);
          displayScannedData(qrCodeMessage);
        }

        function onScanError(error) {
          console.error("Error processing QR code:", error);
        }

        function displayScannedData(data) {
          // Handle the scanned QR code message
          document.getElementById("scanned-data").innerText = data;
        }
      </script>
      <?php
        // include "../attendance/attendance table.php";
      ?>
    </div>
  </body>
</html>
