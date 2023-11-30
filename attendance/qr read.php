<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href=" ../css/dist/tailwind.min.css" rel="stylesheet"> 
    <title>Document</title>
    <style>
       .confirm-button-class {
           @apply bg-green-500 text-white py-2 px-4 rounded;
       }

       .title-class {
           @apply text-xl font-bold;
       }

       .icon-class {
           @apply text-4xl;
       }
   </style>
</head>
<body>
    
</body>
</html>
<?php
session_start(); // Start the session

$secretKey = '2WWkTlbi1dmdYARRyLbrjOs6nf5o9uRa';

// Check if the username is set in the session
if (isset($_SESSION['username'])) {
    $sessionUsername = $_SESSION['username'];

    // Check if the username in the session matches the username in QR scanning
    if (isset($_GET['data'])) {
        $encodedData = $_GET['data'];
        // Reverse URL-safe encoding
        $decodedData = str_replace(['-', '_'], ['+', '/'], $encodedData);
        // Split the IV and encrypted data
        list($encodedIV, $encodedEncryptedData) = explode('|', $decodedData);
        // Base64 decode the IV and encrypted data
        $iv = base64_decode($encodedIV);
        $encryptedData = base64_decode($encodedEncryptedData);
        // Decrypt the data using the IV and secret key
        $decryptedData = openssl_decrypt($encryptedData, 'AES-256-CBC', $secretKey, OPENSSL_RAW_DATA, $iv);

        if ($decryptedData === $sessionUsername) {
            // Continue with the scanning process since the usernames match
            $dbhost = 'localhost';
            $dbuser = 'root';
            $dbpass = '';
            $dbname = 'interns_management';

            $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

            // Check the connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }

            date_default_timezone_set('Asia/Manila');
            $current_time = date('H:i:s');
            $current_date = date('Y-m-d');
            $username = $decryptedData;

            // Check if the user has already submitted attendance for the current date
            $sql_check = "SELECT morning_timein, lunch_timeout, after_lunch_timein, end_of_day_timeout, rendered_hours FROM attendance WHERE attendance_date = ? AND username = ?";
            $stmt_check = $mysqli->prepare($sql_check);
            $stmt_check->bind_param("ss", $current_date, $username);
            $stmt_check->execute();
            $stmt_check->store_result();
            $stmt_check->bind_result($morning_timein, $lunch_timeout, $lunch_timein, $end_out, $rendered_hours);
            $stmt_check->fetch();

            if ($stmt_check->num_rows > 0) {
                if ($morning_timein != null && $lunch_timeout == "00:00:00") {
                    // Update the record with lunch time out
                    $sql_update_lunchout = "UPDATE attendance SET lunch_timeout = ? WHERE attendance_date = ? AND username = ?";
                    $lunch_timeout_stmt = $mysqli->prepare($sql_update_lunchout);
                    $lunch_timeout_stmt->bind_param("sss", $current_time, $current_date, $username);
                    $lunch_timeout_stmt->execute();
                    if ($lunch_timeout_stmt->affected_rows > 0) {
                        echo "<script>
                        Swal.fire({
                         title: 'Success!',
                         text: 'Lunch Time Out recorded successfully for $current_date.',
                         icon: 'success',
                         confirmButtonColor: '#2e8b57',
                         confirmButtonText: 'OK'
                        }).then((result) => {
                         if (result.isConfirmed) {
                           window.location.href = 'attendance form.php';
                         }
                        });
                        </script>";
                        
                    } else {
                        echo "<script>alert('Error updating Lunch Time Out: " . $lunch_timeout_stmt->error . "');";
                        echo "window.location.href = 'attendance form.php';</script>";
                    }
                    $lunch_timeout_stmt->close();
                } elseif ($lunch_timeout != null && $lunch_timein == "00:00:00") {
                    $sql_update_lunchin = "UPDATE attendance SET after_lunch_timein = ? WHERE attendance_date = ? AND username = ?";
                    $lunch_timein_stmt = $mysqli->prepare($sql_update_lunchin);
                    $lunch_timein_stmt->bind_param("sss", $current_time, $current_date, $username);
                    $lunch_timein_stmt->execute();
                    if ($lunch_timein_stmt->affected_rows > 0) {
                        echo "<script>
                        Swal.fire({
                            title: 'Success!',
                            text: 'Lunch Time In recorded successfully for $current_date.',
                            icon: 'success',
                            confirmButtonColor: '#2e8b57',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'attendance form.php';
                            }
                        });
                       </script>";
                       
                    } else {
                        echo "<script>alert('Error updating Lunch Time In: " . $lunch_timein_stmt->error . "');";
                        echo "window.location.href = 'attendance form.php';</script>";
                    }
                    $lunch_timein_stmt->close();
                } elseif ($lunch_timein != null && $end_out == "00:00:00") {
                    // Calculate the total hours worked
                    $morning_timein_timestamp = strtotime($morning_timein);
                    $lunch_timeout_timestamp = strtotime($lunch_timeout);
                    $lunch_timein_timestamp = strtotime($lunch_timein);
                    $end_of_day_timeout_timestamp = strtotime($current_time);
                    $total_seconds_worked = $end_of_day_timeout_timestamp - $morning_timein_timestamp - ($lunch_timein_timestamp - $lunch_timeout_timestamp);
                    $rendered_hours = gmdate('H:i:s', $total_seconds_worked);

                    // Update the database with the calculated rendered hours
                    $sqlUpdateEndOfDay = "UPDATE attendance SET end_of_day_timeout = ?, rendered_hours = ? WHERE attendance_date = ? AND username = ?";
                    $endOfDayStmt = $mysqli->prepare($sqlUpdateEndOfDay);
                    $endOfDayStmt->bind_param("ssss", $current_time, $rendered_hours, $current_date, $username);
                    $endOfDayStmt->execute();

                    if ($endOfDayStmt->affected_rows > 0) {
                        echo "<script>
                        Swal.fire({
                            title: 'Success!',
                            text: 'End of Day Time out recorded successfully for $current_date.',
                            icon: 'success',
                            confirmButtonColor: '#2e8b57',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'attendance form.php';
                            }
                        });
                        </script>";

                    } else {
                        echo "<script>alert('Error updating End of Day: " . $endOfDayStmt->error . "');";
                        echo "window.location.href = 'attendance form.php';</script>";
                    }

                    $endOfDayStmt->close();
                }
            } else {
                // Insert the record with morning time in
                $sql = "INSERT INTO attendance (attendance_date, username, morning_timein) VALUES (?, ?, ?)";
                $stmt_insert = $mysqli->prepare($sql);
                $stmt_insert->bind_param("sss", $current_date, $username, $current_time);
                $stmt_insert->execute();
                if ($stmt_insert->affected_rows > 0) {
                    echo '<script>
                    Swal.fire({
                        title: "Error!",
                        text: "Username does not match the scanned username.",
                        icon: "error",
                        confirmButtonText: "OK",
                        confirmButtonColor: "#2E8B57" 
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "attendance form.php";
                        }
                    });
                  </script>';      
                } else {
                    echo "<script>alert('Error inserting Morning Time In: " . $stmt_insert->error . "');";
                    echo "window.location.href = 'attendance form.php';</script>";
                }
                $stmt_insert->close();
            }

            $stmt_check->close();
            $mysqli->close(); // Close the database connection
        } else {
            echo '<script>
            Swal.fire({
                title: "Error!",
                text: "Username does not match the scanned username.",
                icon: "error",
                confirmButtonText: "OK"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "attendance form.php";
                }
            });
         </script>';
         
        }
    } else {
        echo "No encrypted data found in the URL parameter.";
    }
} else {
    echo "Username not set in the session.";
}

?>
