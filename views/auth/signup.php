<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Signup Page</title>
</head>
<body class="bg-gradient-to-b from-gray-800 to-gray-700 min-h-screen flex items-center justify-center">
  <div class="w-full max-w-md bg-gray-800 p-8 rounded-lg shadow-md text-white">
    <!-- Logo -->
    <div class="flex justify-center mb-8">
      <div class="bg-white h-12 w-12 rounded-lg flex items-center justify-center">
        <!-- Logo Icon -->
        <svg class="h-8 w-8 text-gray-800" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 0L0 6v8l10 6 10-6V6L10 0z" />
        </svg>
      </div>
    </div>

    <!-- Login Form -->
    <form action="/register" method="post">
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-400">NAME</label>
            <input type="text" id="name" name="name" class="mt-1 w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="name" required>
          </div>  
      <!-- Email -->
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-400">EMAIL ADDRESS</label>
        <input type="email" id="email" name="email" class="mt-1 w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="exemple@gmail.com" required>
      </div>

      <!-- Password -->
      <div class="mb-6 relative">
        <label for="password" class="block text-sm font-medium text-gray-400">PASSWORD</label>
        <input type="password" id="password" name="password" class="mt-1 w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="********" required>
      </div>

      <!-- Login Button -->
      <input type="submit" name="signup" value="Register"
       class="w-full py-2 rounded-lg bg-blue-500 hover:bg-blue-600 text-white text-lg font-semibold">
</input>
    </form>

    <!-- Back to store -->
    <div class="flex justify-between items-center mb-6">
      <a href="login.html" class="text-gray-400 hover:text-white text-sm">Not a member? <span class="text-blue-400">Log In</span></a>
    </div> 
  </div>
</body>
</html>
