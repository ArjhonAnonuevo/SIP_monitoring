<?php
$secretKey = '2WWkTlbi1dmdYARRyLbrjOs6nf5o9uRa'; 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interns_management";
session_start();
// Check if the username is passed as a parameter
if (isset($_GET["username"])) {
    $username = $_GET["username"];
} else {
    // Check if the username is stored in the session
    if (isset($_SESSION["username"])) {
        $username = $_SESSION["username"];
    } else {
        // Handle the case when the username is not available
        $username = "Unknown"; // Set a default value
    }
}
include "../dashboard/admin_navs.php";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT username FROM interns_account";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='container mx-auto p-4 mt-20 '>";
    echo "<input type='text' id='searchInput' placeholder='Search by username' class='mb-4 p-2 border border-gray-300 rounded'>";
    echo "<div id='qrcodes-container' class='flex flex-wrap h-64 overflow-auto'>"; // Create a container for the QR codes with a fixed height and scrollable content
    $counter = 0; // Counter variable for tracking the number of QR codes generated
    while ($row = $result->fetch_assoc()) {
        $username = $row['username'];

        // Encrypt the values using AES encryption
        $key = $secretKey; // Use the generated secret key
        $iv = random_bytes(16); 
        $encryptedUsername = openssl_encrypt($username, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);

        // Encode IV and encrypted username as URL-safe base64
        $encodedIV = str_replace(['+', '/'], ['-', '_'], base64_encode($iv));
        $encodedEncryptedUsername = str_replace(['+', '/'], ['-', '_'], base64_encode($encryptedUsername));

        // Generate QR code using the encoded values
        echo "<div class='qrcode-container w-full sm:w-1/2 sm:full md:w-1/3 lg:w-1/4 xl:w-1/6 p-4'>";
        echo "<div class='qrcode' id='qrcode{$username}'></div>";
        echo "<link href='../css/dist/tailwind.min.css' rel='stylesheet'>";
        echo "<script src='./node_modules/qrcode-generator/qrcode.js'></script>";
        echo "<script>
            var qr = qrcode(0, 'H');
            qr.addData('{$encodedIV}|{$encodedEncryptedUsername}');
            qr.make();

            var qrCodeImage = document.createElement('img');
            qrCodeImage.src = qr.createDataURL();
            qrCodeImage.style.width = '100%'; // Set the QR code image width to 100% of the container
            qrCodeImage.style.height = 'auto'; // Set the QR code image height to auto to maintain aspect ratio
            document.getElementById('qrcode{$username}').appendChild(qrCodeImage);

            var usernameContainer = document.createElement('div');
            usernameContainer.classList.add('flex', 'flex-col', 'items-center', 'mt-2');
            document.getElementById('qrcode{$username}').appendChild(usernameContainer);

            var usernameElement = document.createElement('div');
            usernameElement.innerText = '{$username}';
            usernameElement.classList.add('text-center'); // Add the 'text-center' class to center-align the text
            usernameContainer.appendChild(usernameElement);

            var downloadLink = document.createElement('a');
            downloadLink.href = qrCodeImage.src;
            downloadLink.download = 'qrcode_{$username}.png';
            downloadLink.innerText = 'Download QR Code';
            downloadLink.style.color = 'blue';
            usernameContainer.appendChild(downloadLink);
        </script>";
        echo "</div>";

        $counter++;
    }

    echo "</div>";
    echo "</div>";

    echo "<script>
        var searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', function() {
            var filter = searchInput.value.toLowerCase();
            var qrcodesContainer = document.getElementById('qrcodes-container');
            var qrcodes = qrcodesContainer.getElementsByClassName('qrcode-container');
            for (var i = 0; i < qrcodes.length; i++) {
                var username = qrcodes[i].getElementsByTagName('div')[1].innerText.toLowerCase();
                if (username.indexOf(filter) > -1) {
                    qrcodes[i].style.display = '';
                } else {
                    qrcodes[i].style.display = 'none';
                }
            }
        });
    </script>";
} else {
    echo "No data found in the tables.";
}

$conn->close();
