<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timesheet</title>
    <link rel="shortcut icon" href="favicon.ico">
</head>
<body>
  <header class="bg-white">
    <div class="mx-auto max-w-7xl py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
      <div class="text-center">
        <h1 class="mt-1 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">Timesheet APP</h1>
        <h2 class="mx-auto mt-5 max-w-xl text-xl text-gray-500">Timesheet is a simple app that helps you track your time at work.</h2>
      <?php 
      if (isset($_SESSION['username'])) {
        echo "<div class='mt-4 sm:mt-0 sm:ml-4'>";
        echo "<h1 class='text-xl font-semibold text-gray-900'>Welcome, " . $_SESSION['username'] . "</h1>";
        echo "<button class='mt-4 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500' onclick='window.location.href=\"?logout\"'>Logout</button>";
        echo "</div>";
      }

      if ($_GET && isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: login.php");
      }
      ?>
      </div>
    </div>
  </header>

  <main class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-xl font-semibold text-gray-900">Timesheet</h1>
      </div>
      <?php if (isset($_SESSION["username"])) { ?>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
        <button type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto add-new">Add user</button>
      </div>
      <?php } ?>
    </div>


    <div class="mt-8 flex flex-col">
      <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">#</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">AM IN</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">AM OUT</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">PM IN</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">PM OUT</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Total</th>
                  <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white">
                  <?php 
                  include_once 'config.php';
                  include_once 'database.php';
                  // =========================================================================
                  // Get Timesheet Data
                  // =========================================================================
                  $sql = "SELECT * FROM timesheet";
                  $result = $conn -> query($sql);
                  // output data of each row
                  while($row = mysqli_fetch_assoc($result)) {
                      echo "<tr>";
                      echo "<td class='whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6'>$row[id]</td>";
                      echo "<td class='whitespace-nowrap px-3 py-4 text-sm text-gray-500'>$row[date]</td>";
                      echo "<td class='whitespace-nowrap px-3 py-4 text-sm text-gray-500'>$row[AM_IN]</td>";
                      echo "<td class='whitespace-nowrap px-3 py-4 text-sm text-gray-500'>$row[AM_OUT]</td>";
                      echo "<td class='whitespace-nowrap px-3 py-4 text-sm text-gray-500'>$row[PM_IN]</td>";
                      echo "<td class='whitespace-nowrap px-3 py-4 text-sm text-gray-500'>$row[PM_OUT]</td>";
                  
                      $time1 = strtotime($row['AM_IN']);
                      $time2 = strtotime($row['AM_OUT']);
                      $time3 = strtotime($row['PM_IN']);
                      $time4 = strtotime($row['PM_OUT']);
                  
                      $diff1 = $time2 - $time1;
                      $diff2 = $time4 - $time3;
                  
                      $diffTotal = $diff1 + $diff2;
                  
                      $hours = floor($diffTotal / 3600);
                      $minutes = floor(($diffTotal / 60) % 60);
                  
                      if ($hours < 10) {
                          $hours = "0" . $hours;
                      }
                    
                      if ($minutes < 10) {
                          $minutes = "0" . $minutes;
                      }
                    
                      echo "<td class='whitespace-nowrap px-3 py-4 text-sm text-gray-500'>$hours:$minutes</td>";
                      if (isset($_SESSION['username'])) {
                        echo "<td class='relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6'>" .
                                "<button class='text-yellow-500 hover:text-yellow-700 mx-2 edit' data-id='$row[id]'>Edit</button>" .
                                "<button class='text-red-500 hover:text-red-700 mx-2 delete' data-id='$row[id]'>Delete</button>" .
                              "</td>";
                      }
                    
                      echo "</tr>";
                  }
                
                  ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer class="bg-white">
    <div class="mx-auto max-w-7xl py-12 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
      <div class="flex justify-center space-x-6 md:order-2">
        <a href="https://github.com/Heyimlulu" class="text-gray-400 hover:text-gray-500">
          <span class="sr-only">GitHub</span>
          <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
          </svg>
        </a>
      </div>
      <div class="mt-8 md:order-1 md:mt-0">
        <p class="text-center text-base text-gray-400">&copy; <?= date('Y'); ?> Lulu. All rights reserved.</p>
      </div>
    </div>
  </footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
<script src="js/crud.js"></script>
</html>