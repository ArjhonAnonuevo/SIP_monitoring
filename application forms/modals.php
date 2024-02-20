<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div id="myModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 overflow-y-auto justify-center hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden max-w-lg mx-auto relative">
            <form action="process_email.php" method="post">
                <div class="modal-header p-6">
                    <button type="button" class="close-btn absolute top-0 right-0 p-4" onclick="modalClose('myModal')">
                        <!-- SVG for close icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0   0   24   24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6   18L18   6M6   6l12   12"></path>
                        </svg>
                    </button>
                    <h3 class="text-3xl font-bold text-green-700">New Message</h3>
                </div>
                <div class="modal-body p-6">
                    <div class="card-body">
                        <div class="compose-toolbar">
                            <label for="recipient" >To:</label>
                            <textarea id="recipientsModal1" name="primary_email" class="w-full h-32 border rounded-md p-2 mt-4 focus:outline-none focus:ring focus:ring-green-700 focus:border-green-700" readonly></textarea>
                        </div>
            
                        <h4 class="mb-2">Message: </h4>
                        <textarea class="w-full h-32 border rounded-md p-2 mt-4 focus:outline-none focus:ring focus:ring-green-700 focus:border-green-700" name="message" placeholder="Type your message here..."></textarea>
                    </div>
                </div>
                <div class="modal-footer p-6 flex justify-end">
                    <button type="reset" class="bg-red-700 hover:bg-red-900 text-white font-bold py-2 px-4 rounded mr-4">Discard</button>
                    <button type="submit" class="bg-green-700 hover:bg-green-900 text-white font-bold py-2 px-4 rounded">Send</button>
                </div>
                </form>
        </div>
    </div>
</div>
<div id="concernModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 overflow-y-auto justify-center hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden max-w-lg mx-auto relative">
            <form action="email_concerns.php" method="post">
                <div class="modal-header p-6">
                <button type="button" class="close-btn absolute top-0 right-0 p-4" onclick="modalClose('concernModal')">
                        <!-- SVG for close icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0   0   24   24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6   18L18   6M6   6l12   12"></path>
                        </svg>
                    </button>
                    <h3 class="text-3xl font-bold text-green-700">Other Concerns</h3>
                </div>
                <div class="modal-body p-6">
                    <div class="card-body">
                        <div class="compose-toolbar">
                            <label for="recipient" >To:</label>
                            <textarea id="recipientsModal2" name="primary_email" class="w-full h-32 border rounded-md p-2 mt-4 focus:outline-none focus:ring focus:ring-green-700 focus:border-green-700" readonly></textarea>
                        </div>
                        <h4 class="mb-2">Message: </h4>
                        <textarea class="w-full h-32 border rounded-md p-2 mt-4 focus:outline-none focus:ring focus:ring-green-700 focus:border-green-700" name="message" placeholder="Type your message here..."></textarea>
                        
                    </div>
                </div>
                <div class="modal-footer p-6 flex justify-end">
                    <button type="reset" class="bg-red-700 hover:bg-red-900 text-white font-bold py-2 px-4 rounded mr-4">Discard</button>
                    <button type="submit" class="bg-green-700 hover:bg-green-900 text-white font-bold py-2 px-4 rounded">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>