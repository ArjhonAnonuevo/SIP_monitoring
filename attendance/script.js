// Get the necessary elements
const scannedTextElement = document.getElementById('scannedText');
const startScanButton = document.getElementById('startScan');
const videoElement = document.getElementById('qrCodeScanner');

// Add click event listener to the start scan button
startScanButton.addEventListener('click', () => {
  // Request camera permission
  navigator.mediaDevices.getUserMedia({ video: true })
    .then((stream) => {
      // Display the video stream in the video element
      videoElement.srcObject = stream;
      videoElement.play();

      // Create a new instance of the QR code scanner
      const qrCodeScanner = new Html5Qrcode('qrCodeScanner');

      // Start scanning
      qrCodeScanner.start(
        { facingMode: 'environment' }, // Use the rear camera
        {
          // Callback function to handle the scanned result
          onScanSuccess: (scannedText) => {
            // Display the scanned text in the input field
            scannedTextElement.value = scannedText;

            // Stop scanning
            qrCodeScanner.stop();
            videoElement.srcObject.getTracks().forEach(track => track.stop());
          },
          // Callback function to handle any errors
          onScanError: (error) => {
            console.error(error);
          },
        }
      );
    })
    .catch((error) => {
      console.error('Camera permission denied:', error);
    });
});
