<!DOCTYPE html>
<html>
<head>
  <title>OCR Scanner</title>
</head>
<body>
  <input type="file" id="file-input">
  <button id="recognize-button">Recognize Text</button>
  <div id="output"></div>

  <script src="https://cdn.jsdelivr.net/npm/tesseract.js@2.4.2/dist/tesseract.min.js"></script>
  <script>
    const fileInput = document.getElementById('file-input');
    const recognizeButton = document.getElementById('recognize-button');
    const output = document.getElementById('output');

    recognizeButton.addEventListener('click', async () => {
      output.textContent = ''; // Clear previous output

      const file = fileInput.files[0];

      if (file) {
        try {
          const worker = Tesseract.createWorker();
          await worker.load();
          await worker.loadLanguage('eng');
          await worker.initialize('eng');
          const { data: { text } } = await worker.recognize(file);
          await worker.terminate();
          output.textContent = text;
        } catch (error) {
          console.error(error);
          output.textContent = "Error occurred during recognition.";
        }
      } else {
        output.textContent = "Please select an image file.";
      }
    });
  </script>
</body>
</html>
