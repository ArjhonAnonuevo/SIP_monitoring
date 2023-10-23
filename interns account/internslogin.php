<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link href="../learning/src/output.css" rel="stylesheet"> 
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="flex flex-wrap min-h-screen w-full content-center justify-center bg-gray-200 py-10">
  <div class="flex shadow-md">
    <div class="flex flex-wrap content-center justify-center rounded-1-lg bg-white" style="width: 24rem; height: 32rem;">
      <div class="w-72">
        <!-- Heading -->
        <h1 class="text-xl font-semibold">Welcome back</h1>
        <small class="text-gray-400">hello</small>

        <!-- Form -->
        <form action="login_process.php" method="post" class="mt-4">
          <div class="mb-3">
            <label class="mb-2 block text-xs font-semibold">Username</label>
            <input type="text" placeholder="Enter your Username" id = "username" name = "username"class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" />
          </div>

          <div class="mb-3">
            <label class="mb-2 block text-xs font-semibold">Password</label>
            <input type="password" placeholder="*****" id="password" name="password" class="block w-full rounded-md border border-gray-300 focus:border-purple-700 focus:outline-none focus:ring-1 focus:ring-purple-700 py-1 px-1.5 text-gray-500" required />
          </div>

          <div class="mb-3 flex flex-wrap content-center">
            <a href="#" class="text-xs font-semibold text-purple-700">Forgot password?</a>
          </div>

          <div class="mb-3">
            <button class="mb-1.5 block w-full text-center text-white bg-purple-700 hover:bg-purple-900 px-2 py-1.5 rounded-md">Login</button>
          </div>
        </form>

        <!-- Footer -->
        <div class="text-center">
          <span class="text-xs text-gray-400 font-semibold">Don't have account?</span>
          <a href="internsregister.php" class="text-xs font-semibold text-purple-700">Sign up</a>
        </div>
      </div>
    </div>

    <!-- Login banner -->
    <div class="flex flex-wrap content-center justify-center rounded-1-lg" style="width: 24rem; height: 32rem;">
    <img class="w-full h-full bg-center bg-no-repeat bg-cover rounded-r-md" src="sec.png">
    </div>

  </div>
</body>
</html>
