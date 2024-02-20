<?php
// Include the Composer autoloader
require_once '../vendor/autoload.php';

// Extend TCPDF with your own class
class PDF extends \TCPDF
{
    public function Header() {
        // Logo
        $image_file = '../tailwind/securities and exchange.png'; // Update with the actual path to your logo image
        $this->Image($image_file, 10, 10, 20, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        
        // Set font for the header (optional)
        $this->SetFont('helvetica', 'B', 10);
        
        // Add a cell with title (optional)
    }
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

$stmt = $conn->prepare("SELECT CONCAT(p.name, ' ', p.mname, ' ', p.lname) AS fullname, p.department FROM interns_profile p INNER JOIN interns_account a ON p.id = a.profile_id WHERE a.username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$name = $row['fullname'];
$department = $row['department']; // Fetch the department



$stmt = $conn->prepare("SELECT morning_timein,lunch_timeout,after_lunch_timein,end_of_day_timeout, attendance_date,rendered_hours FROM attendance WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Function to generate PDF
function generatePDF($result, $name, $department)
{
    // Create instance of PDF class
    $pdf = new PDF();
    $pdf->setPrintHeader(true);
    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('helvetica', '', 10);

    // Add logo
    // $logoPath = '../css/sec.png'; // Update with the actual path to your logo image
    // $pdf->Image($logoPath, 10, 10, 30); // Adjust the coordinates and size as needed
    $pdf->Ln(18);

    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(0, 15, 'MONTHLY ATTENDANCE', 0, 1, 'C');
    
    $pdf->Cell(0, 10, 'Name: ' . $name, 0, 1, 'L');
    $pdf->Cell(0, 10, 'Department: ' . $department, 0, 1, 'L');
    

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
    ob_clean(); // Clean the output buffer
    $pdf->Output('output.pdf', 'D');
}

// Check if the button is clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate_pdf'])) {
    // Call the function to generate PDF
    generatePDF($result, $name, $department);
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Reports</title>
    <?php include "../dashboard/admin_navs2.php"; ?>
    <link href=" ../css/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 sm:px-8">
        <div class="mx-auto md:max-w-7xl md:max-h-min bg-white shadow-md p-6 mt-8 rounded-md">
            <h1 class="text-2xl font-bold text-center mb-4">Attendance Table</h1>
            <div class = "flex flex-row gap-4">
            <form method="post">
                <button type="submit" name="generate_pdf" class="bg-green-900 hover:bg-green-700 mb-4 text-white font-bold py-2 px-4 rounded">
                    Generate PDF
                </button>
            </form>
            <button class="bg-green-900 hover:bg-green-700 mb-4 text-white font-bold py-2 px-4 rounded">Edit Attendance</button>
            </div>
            <div class="overflow-x-auto">
                <div class="bg-white shadow-md overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-green-700 text-white">
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                                    Morning Time In
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                                    Lunch Time Out
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                                    After lunch Time In
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                                    End of the day Time Out
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
                                    Attendance Date
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">
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
    </div>
</body>
</html>

