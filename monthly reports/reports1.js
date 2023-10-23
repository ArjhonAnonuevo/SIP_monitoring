document.addEventListener("DOMContentLoaded", function () {
    var fileNameElement = document.getElementById("fileName");
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "display1.php", true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            var fileNames = JSON.parse(xhr.responseText);

            if (fileNames.length > 0) {
                fileNameElement.textContent = "File Uploads: " + fileNames[0];
            } else {
                fileNameElement.textContent = "No file names found.";
            }
        } else {
            console.error("Failed to retrieve file names");
        }
    };

    xhr.send();
});
var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

var currentDate = new Date();
var currentMonthIndex = currentDate.getMonth();

var previousMonthIndex = currentMonthIndex - 1;
if (previousMonthIndex < 0) {
  previousMonthIndex = 11;
}

var previousMonthName = monthNames[previousMonthIndex];

document.getElementById("nextMonth").textContent = "You can now upload montly reports for the month of " + previousMonthName;

