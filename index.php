<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/styles.css"> -->
</head>
<body>
    <div class="container">
        <div class="table-wrapper">
        <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Timesheet <b>Details</b></h2></div>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-info add-new">Add New</button>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover table-responsive">
                <thead class="align-middle">
                    <th>#</th>
                    <th>Date</th>
                    <th>Morning In</th>
                    <th>Morning Out</th>
                    <th>Afternoon In</th>
                    <th>Afternoon Out</th>
                    <th>Actions</th>
                </thead>
                <tbody class="align-middle">
                    <?php

                    include_once 'config.php';
                    include_once 'database.php';

                    $sql = "SELECT * FROM timesheet";

                    $result = $conn -> query($sql);

                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>$row[id]</td>";
                        echo "<td>$row[date]</td>";
                        echo "<td>$row[AM_IN]</td>";
                        echo "<td>$row[AM_OUT]</td>";
                        echo "<td>$row[PM_IN]</td>";
                        echo "<td>$row[PM_OUT]</td>";
                        echo "<td>" .
                                "<button class='btn btn-sm btn-warning edit mx-1' data-id='$row[id]'>Edit</button>" .
                                "<button class='btn btn-sm btn-danger delete mx-1' data-id='$row[id]'>Delete</button>" .
                            "</td>";
                        echo "</tr>";
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/crud.js"></script>
</html>