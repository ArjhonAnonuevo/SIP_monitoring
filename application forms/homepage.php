<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <!-- Include Tailwind CSS -->
    <link href="../css/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200 overflow-hidden">
    <!-- Navigation Bar -->
    <div class="flex items-center justify-between bg-gray-800 text-white px-10 py-6">
    <div class="flex-1">
        <a href="#" class="inline-flex items-center text-xl">
            <img src="../dashboard/sec.png" alt="" class=" h-10 w-auto">
            <span class="ml-2 font-semibold text-white hover:text-gray-200 sm:text-lg uppercase">Sec Internship program</span>
        </a>
    </div>
    <div class="hidden md:flex space-x-4">
        <a href="#" class="hover:text-gray-300">Pricing</a>
        <a href="#" class="hover:text-gray-300">Product</a>
        <a href="#" class="hover:text-gray-300">About Us</a>
        <a href="#" class="hover:text-gray-300">Contact</a>
        <a href="#" class="hover:text-gray-300">Community</a>
    </div>
    <div class="relative md:hidden">
        <button class="focus:outline-none" type="button">
            <svg class="h-5 w-5 text-white" viewBox="0  0  20  20" fill="currentColor">
                <path fill-rule="evenodd" d="M4  5h12a1  1  0  100-2H4a1  1  0  100  2zm0  6h12a1  1  0  100-2H4a1  1  0  100  2zm0  6h12a1  1  0  100-2H4a1  1  0  100  2z" clip-rule="evenodd"/>
            </svg>
        </button>
        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl">
            <div class="px-2 py-2">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pricing</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Product</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">About Us</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Contact</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Community</a>
            </div>
        </div>
    </div>
</div>
           <div class="flex items-center justify-center h-screen bg-cover bg-center relative" style="background-image: url(../header/sec.png);">
            <div class="bg-black bg-opacity-50 mx-auto flex justify-center items-center w-auto h-5/6 rounded-md">
            <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md ml-10">
                <h2 class="text-2xl font-bold text-center mb-6">Check Application Status</h2>
                <form method = "POST" action = "status.php">
                    <div class="mb-4">
                        <label for="control_num" class="block text-gray-700 text-sm font-bold mb-2">Control Number:</label>
                        <input type="text" id="control_num" name = "control_num" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter your control Number">
                    </div>
                    <div class="flex items-center justify-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-16 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out" type="submit">
                        Check
                    </button>
                </div>
                </form>
            </div>
            <div class="text-center lg:px-12 lg:text-left text-white">
                <h1 class="text-5xl font-bold mb-4">Apply now!</h1>
                <p class="py-6">Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem quasi. In deleniti eaque aut repudiandae et a id nisi.</p>
                <a href="../application%20forms/forms.php" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out mt-4 ">
                Apply Now
            </a>
            </div>
        </div>
    </div>
</body>
</html>
