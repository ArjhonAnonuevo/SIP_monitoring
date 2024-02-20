<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link href="../css/dist/tailwind.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="flex flex-wrap min-h-screen w-full content-center justify-center bg-gray-200 py-10">
      <div class="flex shadow-md">
        <div class="flex flex-wrap content-center justify-center rounded-lg bg-white" style="width: 34rem; height: 32rem;">
          <div class="w-full sm:w-auto sm:max-w-xs md:max-w-sm lg:max-w-md xl:max-w-lg">

            <!-- Heading -->
            <h1 class="text-xl md:flex md:justify-center font-semibold mb-10 font-serif">Registration</h1>

            <!-- Form -->
            <form action="register_process.php" method="post" class="mt-4 flex flex-col">
              <div class="form-page" id="page-1">
                <div class="mb-3 flex">
                  <div class="mr-3">
                    <label for="fname" class=" relative mb-2 block text-xs font-semibold">First Name <span class="text-red-600">*</span></label>
                    <input type="text" placeholder="Enter your Name" id="fname" name="fname" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" />
                  </div>
                  <div class="mr-3">
                    <label class="mb-2 block text-xs font-semibold">Middle Name <span class="required text-red-600">*</span></label>
                    <input type="text" id="mname" name="mname" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" />
                  </div>
                  <div>
                    <label class="mb-2 block text-xs font-semibold">Last Name <span class="required text-red-600">*</span></label>
                    <input type="text" id="lname" name="lname" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" />
                  </div>
                </div>
                <div class="mb-3 flex">
                  <div class="mr-2">
                    <label class="mb-2 block text-xs font-semibold">Age<span class="text-red-600">*</span></label>
                    <input type="number" id="age" name="age" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" readonly />
                  </div>
                  <div>
                    <label class="mb-2 block text-xs font-semibold">Birthday<span class="text-red-600">*</span></label>
                    <input type="date" id="birthday" name="birthday" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" onchange="calculateAge()" />
                  </div>
                </div>
                <div class="mb-3">
                  <label class="mb-2 block text-xs font-semibold">Contact Number<span class="text-red-600">*</span></label>
                  <input type="tel" placeholder="Enter your Contacts" id="contact-number" name="contact-number" class="md:w-auto block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" />
                </div>
                <div class="mb-3 flex">
                  <div class="mr-2">
                    <label class="mb-2 block text-xs font-semibold">School<span class="text-red-600">*</span></label>
                    <input type="text" id="school" name="school" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" />
                  </div>
                  <div>
                    <label class="mb-2 block text-xs font-semibold">Course<span class="text-red-600">*</span></label>
                    <input type="text" id="course" name="course" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="gender" class="text-xs font-semibold">Sex<span class="text-red-600">*</span></label>
                  <div class="flex gap-5">
                    <label class="flex items-center">
                      <input type="radio" name="gender" value="male" checked class="form-radio text-indigo-600">
                      <span class="ml-2">Male</span>
                    </label>
                    <label class="flex items-center">
                      <input type="radio" name="gender" value="female" class="form-radio text-indigo-600">
                      <span class="ml-2">Female</span>
                    </label>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="mb-1.5 block w-40 text-center text-white bg-green-800 rounded-md md:w-20 mt-5 hover:bg-green-700 -px-2 py-1.5" data-current="page-1" data-next="page-2">Next</button>
                </div>
              </div>
              <div class="form-page hidden" id="page-2">
                <div class="mb-3">
                  <label class="mb-2 block text-xs font-semibold" for="department">Department<span class="text-red-600">*</span></label>
                  <select id="department" name="department" class="block w-full rounded-md border  border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500">
                    <option value="ictd">ICTD</option>
                    <option value="crmd">CRMD</option>
                    <option value="fmd">FMD</option>
                    <option value="hrad">HRAD</option>
                    <option value="cgfd">CGFD</option>
                    <option value="eipd">EIPD</option>
                    <option value="ertd">ERTD</option>
                    <option value="ocs">OCS</option>
                    <option value="commisioners">COMMISSIONERS</option>
                    <option value="ogc">OGC</option>
                    <option value="oga">OGA</option>
                    <option value="msrd">MSRD</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label class="mb-2 block text-xs font-semibold">Hours Required<span class="text-red-600">*</span></label>
                  <input type="number" id="hours-required" name="hours-required" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" />
                </div>
                <div class="mb-3">
                  <label class="mb-2 block text-xs font-semibold">Emergency contact<span class="text-red-600">*</span></label>
                  <input type="tel" id="emergency-contact" name="emergency-contact" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" />
                </div>
                <div class="mb-3 flex justify-between">
                  <button class="mb-1.5 block w-20 rounded text-center text-white bg-green-800 hover-bg-green-700 -px-2 py-1.5" data-current="page-2" data-prev="page-1">Previous</button>
                  <button class="mb-1.5 block w-20 rounded text-center text-white bg-green-800 hover-bg-green-700 -px-2 py-1.5" data-current="page-2" data-next="page-3">Next</button>
                </div>
              </div>
              <div class="form-page hidden" id="page-3">
                <div class="mb-3 ">
                  <label class="mb-2 block text-xs font-semibold">Username<span class="text-red-600">*</span></label>
                  <input type="text" id="username" name="username" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" />
                </div>
                <div class="mb-3">
                  <label class="mb-2 block text-xs font-semibold">Password<span class="text-red-600">*</span></label>
                  <input type="password" placeholder="*********" id="password" name="password" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" />
                </div>
                <div class="mb-3">
                  <label class="mb-2 block text-xs font-semibold">Confirm Password<span class="text-red-600">*</span></label>
                  <input type="password" placeholder="*********" id="confirm-password" name="confirm-password" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" />
                </div>
                <div class="mb-3 flex justify-between">
                  <button class="mb-1.5 block md:w-20 rounded text-center text-white bg-green-800 hover-bg-green-700 -px-2 py-1.5" data-current="page-3" data-prev="page-2">Previous</button>
                  <button type="submit" class="mb-1.5 block rounded md:w-20 text-center text-white bg-green-800 hover-bg-green-700 -px-2 py-1.5" data-current="page-3">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="flex flex-wrap content-center justify-center rounded-lg" style="width: 24rem; height: 32rem;">
          <img class="w-full h-full bg-center bg-no-repeat bg-cover rounded-r-md" src="sec.png">
        </div>
      </div>
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        // Get all form pages
        const formPages = document.querySelectorAll(".form-page");
        // Get all "Next" buttons
        const nextButtons = document.querySelectorAll("[data-next]");
        // Get all "Previous" buttons
        const prevButtons = document.querySelectorAll("[data-prev]");
        // Add click event listeners to "Next" buttons
        nextButtons.forEach((button) => {
          button.addEventListener("click", function(event) {
            event.preventDefault();
            const currentPageId = this.getAttribute("data-current");
            const nextPageId = this.getAttribute("data-next");
            showPage(currentPageId, nextPageId);
          });
        });
        prevButtons.forEach((button) => {
          button.addEventListener("click", function(event) {
            event.preventDefault();
            const currentPageId = this.getAttribute("data-current");
            const prevPageId = this.getAttribute("data-prev");
            showPage(currentPageId, prevPageId);
          });
        });
        // Function to show a specific form page
        function showPage(currentPageId, nextPageId) {
          const currentPage = document.getElementById(currentPageId);
          const nextPage = document.getElementById(nextPageId);
          if (currentPage && nextPage) {
            currentPage.classList.add("hidden");
            nextPage.classList.remove("hidden");
          }
        }
        // Show the initial form page
        showPage("page-1", "page-1"); // Show page 1 initially
      });
      function calculateAge() {
        var birthday = new Date(document.getElementById("birthday").value);
        var today = new Date();
        var age = today.getFullYear() - birthday.getFullYear();
        var monthDiff = today.getMonth() - birthday.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthday.getDate())) {
          age--;
        }
        document.getElementById("age").value = age;
      }
    </script>
  </body>
</html>