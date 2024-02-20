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
// Generate a new secret key
$secretKey = generateSecretKey();

// Store the secret key in a file
$filePath = 'secret_key.txt';
if (file_put_contents($filePath, $secretKey) !== false) {
    echo "Secret key generated and stored in '$filePath'";
} else {
    echo "Failed to store the secret key.";
}
?>
