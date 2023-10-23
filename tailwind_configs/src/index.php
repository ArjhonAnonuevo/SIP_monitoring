<?php
include 'dashboard_navs.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        #imageContainer {
            max-width: 200px;
            max-height: 200px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: auto;
        }
        #imagePreview {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
    </style>
</head>
<body>
<!-- component -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="text-center">
                <h2 class="mt-5 display-4 font-weight-bold">
                    File Upload!
                </h2>
                <p class="mt-2 lead text-muted">You can now add a certifications file!</p>
            </div>
            <form class="mt-5" action="upload.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="font-weight-bold">Attach Document or Image</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file" id="fileInput" onchange="displayImagePreview(this)">
                        <label class="custom-file-label" for="fileInput">Choose file</label>
                    </div>
                    <div id="imageContainer" class="mt-3"></div>
                    <p id="fileNamePreview" class="mt-2"></p>
                </div>
                <p class="text-muted">
                    <span>File type: doc, pdf, types of images</span>
                </p>
                <div id="fileFormsContainer">
                    <!-- Existing file submission form -->
                    <div class="file-form">
                        <input type="file" class="custom-file-input" name="file" onchange="displayImagePreview(this)">
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function displayImagePreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var imageContainer = document.getElementById("imageContainer");
                var fileNamePreview = document.getElementById("fileNamePreview");
                if (input.files[0].type.startsWith("image/")) {
                    imageContainer.innerHTML = '<img id="imagePreview" src="' + e.target.result + '" alt="Image Preview">';
                    fileNamePreview.textContent = "";
                } else {
                    imageContainer.innerHTML = "";
                    fileNamePreview.textContent = "File Name: " + input.files[0].name;
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>
</html>
