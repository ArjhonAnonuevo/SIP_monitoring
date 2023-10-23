
function displayFileName(input) {
    const fileNameSpan = input.parentNode.parentNode.querySelector('#fileName');
    const fileImage = input.parentNode.parentNode.querySelector('#fileImage');
    const uploadImage = input.parentNode.parentNode.querySelector('.has-mask');
    if (input.files && input.files.length > 0) {
        const file = input.files[0];
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                fileImage.src = e.target.result;
                fileImage.classList.remove('hidden');
                fileNameSpan.textContent = '';
                uploadImage.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            fileImage.classList.add('hidden');
            fileNameSpan.textContent = file.name;
            uploadImage.classList.remove('hidden');
        }
    } else {
        fileImage.classList.add('hidden');
        fileNameSpan.textContent = '';
        uploadImage.classList.remove('hidden');
    }
}



