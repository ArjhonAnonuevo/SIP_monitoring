<!DOCTYPE html>
<html>
<head>
    <title>JavaScript OCR</title>
</head>
<body>
    <h1>JavaScript OCR</h1>
    <input type="file" accept=".jpg, .png, .jpeg" id="fileInput">
    <button onclick="processImage()">Extract Text</button>
    <div id="output">
        <h2>Extracted Text:</h2>
        <p id="extractedText"></p>
    </div>

    <!-- Updated CDN link for tesseract.js -->
    <script src="https://cdn.jsdelivr.net/gh/naptha/tesseract.js@2/dist/tesseract.min.js"></script>

    <script>
        function processImage() {
            const fileInput = document.getElementById('fileInput');
            const output = document.getElementById('extractedText');

            if (fileInput.files.length > 0) {
                const image = fileInput.files[0];
                console.log(image); // Log the image to the console

                Tesseract.recognize(
                    image,
                    'eng',
                    { logger: info => console.log(info) }
                ).then(({ data: { text } }) => {
                    output.textContent = text;
                }).catch(error => console.error(error));
            } else {
                alert("Please select an image.");
            }
        }
    </script>
</body>
</html>
