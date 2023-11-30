<?php
// Include the Composer autoloader
require_once '../vendor/autoload.php';


// Extend TCPDF with your own class
class PDF extends \TCPDF
{
}

// Your existing code for database connection and query
$username = $_GET['username'];
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "interns_management";
$conn = new mysqli($servername, $username_db, $password_db, $dbname);
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT CONCAT(p.name, ' ', p.mname, ' ', p.lname) AS fullname FROM interns_profile p INNER JOIN interns_account a ON p.id = a.profile_id WHERE a.username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$name = $result->fetch_assoc()['fullname'];
    
$stmt = $conn->prepare("SELECT morning_timein,lunch_timeout,after_lunch_timein,end_of_day_timeout, attendance_date,rendered_hours FROM attendance WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Function to generate PDF
function generatePDF($result,$name)
{
 // Create instance of PDF class
 $pdf = new PDF();
 $pdf->setPrintHeader(false);
 // Add a page
 $pdf->AddPage();

 // Set font
 $pdf->SetFont('helvetica', '', 10); 
 // Add logo
 $pdf->Image('../css/sec.png', 10, 10, 30, 30); 
 $pdf->Cell(0, 10, 'Name: ' . $name, 0, 1, 'L'); 
 $pdf->Cell(0, 10, 'Attendance Data', 0, 1, 'C');

 // Table headers
 $pdf->SetFont('helvetica', 'B', 8); 
 $pdf->Cell(30, 10, 'Morning Time In', 1);
 $pdf->Cell(30, 10, 'Lunch Time Out', 1);
 $pdf->Cell(30, 10, 'After Lunch Time In', 1);
 $pdf->Cell(34, 10, 'End of the day Time Out', 1);
 $pdf->Cell(30, 10, 'Attendance Date', 1);
 $pdf->Cell(30, 10, 'Rendered Hours', 1);
 $pdf->Ln();

 // Table data
 while ($row = $result->fetch_assoc()) {
     $pdf->Cell(30, 10, $row['morning_timein'], 1);
     $pdf->Cell(30, 10, $row['lunch_timeout'], 1);
     $pdf->Cell(30, 10, $row['after_lunch_timein'], 1);
     $pdf->Cell(34, 10, $row['end_of_day_timeout'], 1);
     $pdf->Cell(30, 10, $row['attendance_date'], 1);
     $pdf->Cell(30, 10, $row['rendered_hours'], 1);
     $pdf->Ln();
 }

 // Output the PDF to the browser
 $pdf->Output('output.pdf', 'D');
}

// Check if the button is clicked
if (isset($_POST['generate_pdf'])) {
 // Call the function to generate PDF
 generatePDF($result,$name);
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Monthly Reports</title>
    <?php include "../dashboard/admin_navs2.php";?>
        <link href=" ../css/dist/tailwind.min.css" rel="stylesheet"> 
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <h1 class="text-2xl font-bold text-center mb-4">Attendance Table</h1>
            <form method="post">
                <button type="submit" name="generate_pdf" class="bg-green-900 hover:bg-green-700 mb-4 text-white font-bold py-2 px-4 rounded">
                    Generate PDF
                </button>
            </form>
            <div class="shadow overflow-hidden rounded border-b border-gray-200">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Morning Time In
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Lunch Time Out
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                After lunch Time In
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                End of the day Time Out
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Attendance Date
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Rendered Hours
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td class="px-5 py-3 sm:py-5 md:py-3 lg:py-5 xl:py-3 border-b border-gray-200 bg-white text-sm"><?php echo $row['morning_timein']; ?></td>
                                <td class="px-5 py-3 sm:py-5 md:py-3 lg:py-5 xl:py-3 border-b border-gray-200 bg-white text-sm"><?php echo $row['lunch_timeout']; ?></td>
                                <td class="px-5 py-3 sm:py-5 md:py-3 lg:py-5 xl:py-3 border-b border-gray-200 bg-white text-sm"><?php echo $row['after_lunch_timein']; ?></td>
                                <td class="px-5 py-3 sm:py-5 md:py-3 lg:py-5 xl:py-3 border-b border-gray-200 bg-white text-sm"><?php echo $row['end_of_day_timeout']; ?></td>
                                <td class="px-5 py-3 sm:py-5 md:py-3 lg:py-5 xl:py-3 border-b border-gray-200 bg-white text-sm"><?php echo $row['attendance_date']; ?></td>
                                <td class="px-5 py-3 sm:py-5 md:py-3 lg:py-5 xl:py-3 border-b border-gray-200 bg-white text-sm"><?php echo $row['rendered_hours']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
