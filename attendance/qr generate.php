<?php
function generateSecretKey($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $secretKey = '';
    for ($i = 0; $i < $length; $i++) {
        $secretKey .= $characters[rand(0, $charactersLength - 1)];
    }

    return $secretKey;
}
$secretKey = generateSecretKey();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interns_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT interns_profile.name, interns_account.username
        FROM interns_profile
        JOIN interns_account ON interns_profile.id = interns_account.profile_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $username = $row['username'];

        // Encrypt the values using AES encryption
        $key = $secretKey; // Use the generated secret key
        $iv = random_bytes(16); 
        $encryptedName = openssl_encrypt($name, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
        $encryptedUsername = openssl_encrypt($username, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);

        // Generate QR code using the encrypted values
        $data = base64_encode($iv) . '|' . base64_encode($encryptedName) . '|' . base64_encode($encryptedUsername);

        // Output the QR code image
        $qrCode = file_get_contents('https://cdn.jsdelivr.net/npm/qrcode-generator/qrcode.min.js');
        echo "<script>{$qrCode}</script>";

        echo "<div id='qrcode'></div>";

        echo "<script>
            var qr = qrcode(0, 'L');
            qr.addData('{$data}');
            qr.make();

            var qrCodeImage = document.createElement('img');
            qrCodeImage.src = qr.createDataURL();
            document.getElementById('qrcode').appendChild(qrCodeImage);
        </script>";
    }
} else {
    echo "No data found in the tables.";
}

$conn->close();
?>
