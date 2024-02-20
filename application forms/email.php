    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Page Title</title>
        <!-- Include SweetAlert from CDN -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>

    </body>
    </html>
    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php';
    // passing true in constructor enables exceptions in PHPMailer
    $mail = new PHPMailer(true);

    try {
    // Server settings
    $mail->SMTPDebug = 0; // disable debug output
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = 'aaanonuevo05@gmail.com'; // YOUR gmail email
    $mail->Password = 'zkuz velx nzbq spsy'; // YOUR gmail app password

    // Sender and recipient settings
    $mail->setFrom('aaanonuevo05@gmail.com', 'SEC Internship Program');

    // Assuming $data is an array containing a 'email' key
    $data = $_POST; // Replace this with the actual source of your $data array

    if (isset($data) && is_array($data)) {
    $mail->addAddress($data['email'], 'Receiver Name');
    } else {
    echo "Error: $data is not set or is not an array.";
    }

    $mail->addReplyTo('aaanonuevo05@gmail.com', 'Sender Name'); // to set the reply to

    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = "Welcome to Securities and Exchange Commission (SEC)";
    $mail->Body = $_POST['emailMessage'] . " On " . $_POST['date'] . " at " . $_POST['time'] . ".<br><br>" .
        "<ul>" .
        "<li>URL: " . $_POST['url'] . "</li>" .
        "<li>Meeting ID: " . $_POST['meetingId'] . "</li>" .
        "<li>Passcode: " . $_POST['passcode'] . "</li>" .
        "</ul>" .

        "<span style='font-size: 13px;'>Kindly confirm your attendance on or before the scheduled interview. If you have further queries or concerns, please contact us through this email or at (+632) 8818-5994.</span>" .
        "<br><br>" .
        "<span style='font-size: 13px;'>Furthermore, kindly send us the accomplished Personal Data Sheet (PDS). Thank you, and we look forward to seeing you virtually.</span>" .
        "<br><br>" .
        "<span style='font-size: 13px;'>For the SIP Management Team,</span>" .
        "<br><br>" .

        "<span style='font-size: 13px; font-weight: bold;'>Portia Gema A. Abad</span>" .
        "<br>" .
        "<span style='font-size: 12px; font-weight: bold;'>Program Management Team</span>" .
        "<br>" .
        "<span style='font-size: 12px; color:#274e13; font-weight: bold;'>SEC Internship Program</span>" .
        "<br><br>" .
        "<span style='font-size: 12px; color:#274e13; font-weight: bold;'>Learning Resource and Information Division</span>" .
        "<br>" .
        "<span style='font-size: 12px; color:#274e13; font-weight: bold;'>Human Resource and Administrative Department</span>" .
        "<br><br>" .
        "<span style='font-size: 12px; color:#8c8c8c; '>Telephone: +63 2 8818 5994</span>" .
        "<br><br>" .
        "<span style='font-size: 12px; color:#274e13; font-weight: bold;  font-family: Times New Roman, Times, serif;'>Securities and Exchange Commission</span>" .
        "<br>" .
        "<span style='font-size: 12px; color:#8c8c8c; font-family: Times New Roman, Times, serif;'>The gateway to doing business in the Philippines</span>" .
        "<br><br>" .

        "<img src='../dashboard/sec.png' alt='Company Logo'>" .
        "<footer>" .
        "<a href='#link1' style = 'color: gray; font-size: 11px; '>Official Website</a> |" .
        "<a href='#link2' style = 'color: gray; font-size: 11px; '> Facebook</a> |" .
        "<a href='#link3' style = 'color: gray; font-size: 11px; '> Twitter</a> |" .
        "<a href='#link2' style = 'color: gray; font-size: 11px; '> Linkdln</a> |" .
        "<br>".
        "<br>".
        "<span style='font-size: 11px; font-weight: bold;'>CONFIDENTIALITY AND PRIVACY NOTICE: </span>" .
        "<span style='font-size: 11px;'>This email message, including the attachments, if any, contains confidential information which may be privileged or otherwise protected from disclosure and intended solely for the use of the individual or entity to whom it is addressed and others authorized to receive it. If you have received this email by mistake, please notify the sender immediately via return email and delete the document and any copies thereof. This message is protected under R.A. No. 4200 (The Anti-Wire Tapping Law), R.A. No. 8792 (The E-Commerce Law), A.M. No. 01-7-01-SC (Rules on Electronic Evidence), and Republic Act No. 10173 (The Data Privacy Act of 2012).</span>" .
        "</footer>";

    $mail->AltBody = $_POST['emailMessage'] . " " . $_POST['date'] . " at " . $_POST['time'] . "." .
                " URL: " . $_POST['url'] . 
                " Meeting ID: " . $_POST['meetingId'] . 
                " Passcode: " . $_POST['passcode'];
    $mail->send();
    echo "<script>
    Swal.fire({
    title: 'Success',
    text: 'Email message sent.',
    icon: 'success'
    }).then(() => {
    window.location.href = 'interns_table.php';
    });
    </script>";
    } catch (Exception $e) {
    // Use SweetAlert for error
    echo "<script>
    Swal.fire({
    title: 'Error',
    text: 'Error in sending email. Mailer Error: {$mail->ErrorInfo}',
    icon: 'error'
    });
    </script>";
    }
    ?>