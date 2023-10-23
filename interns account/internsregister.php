<?php
include "db_config.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link href="../learning/src/output.css" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
  </head>
  <body>
    <div class="flex flex-wrap min-h-screen w-full content-center justify-center bg-gray-200 py-10">
      <div class="flex shadow-md">
        <div class="flex flex-wrap content-center justify-center rounded-1-lg bg-white" style="width: 24rem; height: 40 rem;">
          <div class="w-72">

            <!-- Heading -->
            <h1 class="text-xl font-semibold">Register</h1>
            <small class="text-gray-400">Create a new account</small>

            <!-- Form -->
            <form action="register_process.php" method="post" class="mt-4">
              <div class="form-page" id="page-1">
                <div class="mb-3">
                  <label class="mb-2 block text-xs font-semibold">Name</label>
                  <input type="text" placeholder="Enter your Name" id="name" name="name" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" required />
                </div>
                <div class="mb-3">
                  <label class="mb-2 block text-xs font-semibold">Gender</label>
                  <select id="gender" name="gender" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                  </select>
                </div>
                <div class="form-group mb-3">
                  <label for="age" class="block text-xs font-semibold">Age</label>
                  <input type="number" id="age" name="age" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" required>
                </div>
                <div class="form-group mb-3">
                  <label for="birthday" class="block text-xs font-semibold">Birthday</label>
                  <input type="date" id="birthday" name="birthday" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" required>
                </div>
                <div class="form-group mb-3">
                  <label for="contact-number" class="block text-xs font-semibold">Contact Number</label>
                  <input type="tel" id="contact-number" name="contact-number" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" required>
                </div>
                <div class="form-group mb-3">
                  <label for="school" class="block text-xs font-semibold">School</label>
                  <input type="text" id="school" name="school" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" required>
                </div>
                <div class="form-group mb-3">
                  <label for="course" class="block text-xs font-semibold">Course</label>
                  <input type="text" id="course" name="course" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" required>
                </div>
                <button type="button" class="mb-1.5 block w-full text-center text-white bg-purple-700 hover:bg-purple-900 px-2 py-1.5 rounded-md next-page" data-next="page-2">Next</button>
              </div>

              <!-- Include additional form fields for page 1 here -->
              <div class="form-page" id="page-2" style="display: none">
                <div class="form-group mb-3">
                  <label for="department" class="block text-xs font-semibold">Designated Department</label>
                  <input type="text" id="department" name="department" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" required>
                </div>
                <div class="form-group mb-3">
                  <label for="hours-required" class="block text-xs font-semibold">Hours Required</label>
                  <input type="number" id="hours-required" name="hours-required" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" required>
                </div>
                <div class="form-group mb-3">
                  <label for="emergency-contact" class="block text-xs font-semibold">Emergency Contact</label>
                  <input type="tel" id="emergency-contact" name="emergency-contact" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" required>
                </div>
                <button type="button" class="mb-1.5 block w-full text-center text-white bg-purple-700 hover:bg-purple-900 px-2 py-1.5 rounded-md prev-page" data-prev="page-1">Previous</button>
                <button type="button" class="mb-1.5 block w-full text-center text-white bg-purple-700 hover:bg-purple-900 px-2 py-1.5 rounded-md next-page" data-next="page-3">Next</button>
              </div>
              <div class="form-page" id="page-3" style="display: none">
                <div class="form-group mb-3">
                  <label for="username" class="block text-xs font-semibold">Username</label>
                  <input type="text" id="username" name="username" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" required>
                </div>
                <div class="form-group mb-3">
                  <label for="password" class="block text-xs font-semibold">Password</label>
                  <input type="password" id="password" name="password" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" required>
                </div>
                <div class="form-group mb-3">
                  <label for="confirm-password" class="block text-xs font-semibold">Confirm Password</label>
                  <input type="password" id="confirm-password" name="confirm-password" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" required>
                </div>
                <button type="button" class="mb-1.5 block w-full text-center text-white bg-purple-700 hover-bg-purple-900 px-2 py-1.5 rounded-md prev-page" data-prev="page-2">Previous</button>
                <button type="submit" class="mb-1.5 block w-full text-center text-white bg-purple-700 hover:bg-purple-900 px-2 py-1.5 rounded-md">Submit</button>
              </div>
          </div>
          </form>
          <!-- Footer -->
          <div class="text-center">
            <span class="text-xs text-gray-400 font-semibold">Already have an account?</span>
            <a href="internslogin.php" class="text-xs font-semibold text-purple-700">Login</a>
          </div>
        </div>
      </div>
      <!-- Registration banner -->
      <div class="flex flex-wrap content-center justify-center rounded-1-lg" style="width: 24rem; height: 40rem;">
        <img class="w-full h-full bg-center bg-no-repeat bg-cover rounded-r-md" src="sec.png">
      </div>
    </div>
    <script src="register.js"></script>
  </body>
</html>