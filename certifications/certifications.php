<!DOCTYPE html>
<html>
<head>
  <title>File Upload Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .file-input {
      margin-bottom: 10px;
    }
    .file-input.drag-over {
      border: 2px dashed #007bff;
    }
    .file-preview {
      margin-top: 10px;
      max-width: 10px; 
      height: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>File Upload Form</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
      <div id="file-input-container">
        <!-- Initial file input -->
        <div class="custom-file">
          <input type="file" name="files[]" class="custom-file-input file-input" id="file-input-1">
          <label class="custom-file-label" for="file-input-1" style="display: none;">Choose file</label> 
        </div>
        <div class="file-preview" id="file-preview-1"></div>
      </div>
      <button type="button" class="btn btn-primary mt-3" onclick="addFileInput()">Add Another File</button>
      <br>
      <input type="submit" class="btn btn-success mt-3" value="Upload">
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
   function addFileInput() {
      var container = document.getElementById("file-input-container");
      var inputIndex = container.childElementCount + 1;
      
      // Create a new file input element
      var fileInput = document.createElement("div");
      fileInput.className = "custom-file";
      fileInput.innerHTML = `
        <input type="file" name="files[]" class="custom-file-input file-input" id="file-input-${inputIndex}">
        <label class="custom-file-label" for="file-input-${inputIndex}">Choose file</label>
        <div class="file-preview" id="file-preview-${inputIndex}"></div>
      `;
      
      // Append the new file input to the container
      container.appendChild(fileInput);
      
      // Add an event listener to the new file input
      fileInput.querySelector('.file-input').addEventListener('change', handleFileInputChange);
      handleFileInputChange.call(fileInput.querySelector('.file-input'));
    }

    function handleFileInputChange() {
      var fileInput = this;
      var fileName = fileInput.files[0].name;
      fileInput.nextElementSibling.innerText = fileName;

      // Check if the file is an image
      if (fileInput.files[0].type.startsWith('image/')) {
        var reader = new FileReader();
        reader.onload = function(e) {
          var preview = fileInput.closest('.custom-file').querySelector('.file-preview');
          preview.innerHTML = '<img src="' + e.target.result + '">';
        };
        reader.readAsDataURL(fileInput.files[0]);
      } else {
        var preview = fileInput.closest('.custom-file').querySelector('.file-preview');
        preview.innerHTML = '<pre>' + fileName + '</pre>';
      }
    }

    // Add event listeners to existing file input elements
    var fileInputs = document.querySelectorAll('.file-input');
    fileInputs.forEach(function (fileInput) {
      fileInput.addEventListener('change', function() {
        handleFileInputChange.call(this);
      });
    });
  </script>
</body>
</html>
