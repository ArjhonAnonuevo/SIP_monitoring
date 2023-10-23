document.addEventListener("DOMContentLoaded", function () {
    var fileNameElement = document.getElementById("fileName");
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "reset.php", true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var previousMonth = response.previousMonth;
                
            var currentDate = new Date();
            var previousMonth = (currentDate.getMonth() + 11) % 12 + 1;

            if (previousMonth != currentMonth) {
                fileNameElement.textContent = "No file names found.";
            }
        else {
            console.error("Failed to retrieve month");
        }
    };
    xhr.send();
}});
