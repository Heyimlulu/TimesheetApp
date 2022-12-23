<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timesheet - Sign in</title>
    <link rel="shortcut icon" href="favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        plugins: [
        require('@tailwindcss/forms'),
    ],
    }
  </script>
</head>
<body>
<div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-md">
    <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Sign in</h2>
  </div>

  <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
      <form class="space-y-6" action="#" method="POST">
        <div>
          <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
          <div class="mt-1">
            <input id="username" name="username" type="username" autocomplete="email" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
          </div>
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <div class="mt-1">
            <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
          </div>
        </div>

        <div class="flex items-center justify-between">
          <div class="text-sm">
            <a href="register.php" class="font-medium text-indigo-600 hover:text-indigo-500">Don't have an account?</a>
          </div>
        </div>

        <div>
          <button type="submit" name="submit" class="flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Sign in</button>
        </div>
      </form>

      <?php
      include_once 'config.php';

      if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = $conn -> query("SELECT * FROM users WHERE username = '$username'");
        $row = $result -> fetch_assoc();

        if (password_verify($password, $row["password"])) {
          session_start();
          $_SESSION["user"]["id"] = $row["id"];
          $_SESSION["user"]["username"] = $row["username"];
          header("Location: index.php");
        } else {
          echo "<p class='text-red-500 text-center'>Incorrect username or password</p>";
        }
      }

      ?>
    </div>
  </div>
</div>
</body>
</html>