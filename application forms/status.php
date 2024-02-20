<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Status</title>
    <link href="../css/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 overflow-hidden">
    <section class="bg-white shadow-md rounded-lg p-6 max-w-sm mx-auto mt-28">
        <h1 class="text-xl font-semibold mb-2">Applicant Status</h1>
        <div class="flex items-center space-x-2">
            <div class="w-12 h-12 rounded-full bg-green-500 flex items-center justify-center">
                <span class="text-white text-2xl">A</span>
            </div>
            <div>
                <p class="text-gray-700">Applicant Name</p>
                <p class="flex items-center space-x-2">
                    <span class="h-2 w-2 rounded-full bg-green-500"></span>
                    <span class="text-gray-500" aria-live="polite">Status: Accepted</span>
                </p>
                <div class="flex justify-center items-center text-center">
                    <a href="otp.php" class="text-xs underline text-blue-800 cursor-pointer text-center">Edit Response</a>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
