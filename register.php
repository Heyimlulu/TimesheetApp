<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timesheet - Sign up</title>
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
    <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Create an account</h2>
  </div>

  <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">

      <form class="space-y-6" method="POST">
        <div>
          <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
          <div class="mt-1">
            <input id="username" name="username" type="username" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
          </div>
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <div class="mt-1">
            <input id="password" name="password" type="password" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
          </div>
        </div>

        <div>
          <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
          <div class="mt-1">
            <input id="confirm_password" name="confirm_password" type="password" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
          </div>
        </div>

        <div class="flex items-center justify-between">
          <div class="text-sm">
            <a href="login.php" class="font-medium text-indigo-600 hover:text-indigo-500">Already have an account?</a>
          </div>
        </div>

        <div>
          <button type="submit" name="submit" class="flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Sign up</button>
        </div>
      </form>

      <?php
      include_once 'config.php';

      $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        password VARCHAR(255) NOT NULL
      )";

      if (mysqli_query($conn, $sql)) {
        echo "";
      } else {
        echo "Error creating table: " . mysqli_error($conn);
      }

      if (isset($_POST["submit"])) {
        $array = array('username' => $_POST['username'], 'password' => $_POST['password'], 'confirm_password' => $_POST['confirm_password'] );

        // check if username already exists
        $sql = "SELECT username FROM users WHERE username = '$array[username]'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          echo "Username already exists";
        } else {
          if ($array['password'] == $array['confirm_password']) {
            $username = $array['username'];
            $password = password_hash($array['password'], PASSWORD_DEFAULT);
  
            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
  
            if (mysqli_query($conn, $sql)) {
              echo "Account created successfully";
              header("Location: login.php");
            } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
          } else {
            echo "Passwords do not match";
          }
        }

      }
      ?>

    </div>
  </div>
</div>
</body>
</html>