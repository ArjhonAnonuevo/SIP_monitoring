<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/dist/output.css" rel="stylesheet">
    <title>Document</title>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-200">
    <div class="container max-w-md mx-auto px-4 py-8 bg-gradient-to-r from-green-800 to-green-800 shadow-lg rounded-lg flex flex-col items-center space-y-6">
        <div class="mb-10">
            <h1 class="text-2xl font-bold font-poppins uppercase text-white">Check Application Status</h1>
        </div>
        
        <!-- Control Number Input -->
        <div class="mb-4">
            <label for="controlNumber" class="block text-white text-sm font-medium mb-2">Control Number:</label>
            <input type="number" id="controlNumber" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100" placeholder="Enter Control Number">
        </div>

        <!-- Submit Button -->
        <button class="transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110 bg-yellow-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50" type="button">
            Submit
        </button>
        <a href="forms.php"><p class = "text- font-semibold underline">Apply now for Internship</p></a>
    </div>
</body>
</html>
