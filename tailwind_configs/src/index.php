<!DOCTYPE html>
<html>
<head>
  <title>OCR Scanner</title>
</head>
<body>
  <input type="file" id="file-input">
  <div id="output"></div>

  <script src="https://cdn.jsdelivr.net/npm/tesseract.js@2.4.2/dist/tesseract.min.js"></script>
  <script>
    const fileInput = document.getElementById('file-input');
    const output = document.getElementById('output');

    fileInput.addEventListener('change', async (e) => {
      const file = e.target.files[0];

      if (file) {
        const { data: { text } } = await Tesseract.recognize(file, 'eng');
        output.textContent = text;
      } else {
        output.textContent = "Please select an image file.";
      }
    });
  </script>
</body>
</html>
