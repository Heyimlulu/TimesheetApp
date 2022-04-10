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
                        <!-- <button type="button" id="add-new" class="btn btn-info">Add New</button> -->
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
                    <th colspan="2">Actions</th>
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
                                "<button class='edit btn btn-warning mx-1' data-id='$row[id]'>Edit</button>" .
                                "<button class='delete btn btn-danger mx-1' data-id='$row[id]'>Delete</button>" .
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
<script>
    $(() => {
        // Fill row with input on add button click
        // $('.add-new').click(() => {
        //     $(this).attr('disabled', "disabled");

        //     $('tbody').append(`
        //         <tr>
        //             <td></td>
        //             <td><input id='user' class='form-control' /></td>
        //             <td><input id='userID' class='form-control' /></td>
        //             <td><input id='message' class='form-control' /></td>
        //             <td><button id='add' class='btn btn-success'>Add</button></td>
        //             <td><button id='delete' class='btn btn-danger'>Delete</button></td>
        //         </tr>
        //     `);
        // });

        // Add new row on add button click
        // $('.add').click(() => {
        //     // check if all inputs are filled or add an error class

        //     let user = $('#user').val();
        //     let userID = $('#userID').val();
        //     let message = $('#message').val();

        //     $.ajax({
        //         url: 'api/add.php',
        //         type: 'POST',
        //         data: {
        //             user: user,
        //             userID: userID,
        //             message: message
        //         },
        //         success: (data) => {
        //             console.log(data);
        //             $('#add-new').removeAttr('disabled');
        //             $('tbody').empty();
        //             $('tbody').append(data);
        //         }
        //     });
        // });

        // Edit button
        $('.edit').on('click', function() {
            $(this).parents('tr').find('td:not(:last-child)').each(function() {
                $(this).html(`<input class='form-control' value='${$(this).text()}' />`);
            });

            $(this).parents('tr').find('td:last-child').html(`
                <button class='update btn btn-success'>Update</button>
                <button class='delete btn btn-danger'>Delete</button>
            `);
        });
        // Update button
        $('.update').on('click', function() {
            let id = $(this).parents('tr').find('td:first-child').find('input').val();
            let date = $(this).parents('tr').find('td:nth-child(2)').find('input').val();
            let AM_IN = $(this).parents('tr').find('td:nth-child(3)').find('input').val();
            let AM_OUT = $(this).parents('tr').find('td:nth-child(4)').find('input').val();
            let PM_IN = $(this).parents('tr').find('td:nth-child(5)').find('input').val();
            let PM_OUT = $(this).parents('tr').find('td:nth-child(6)').find('input').val();

            $.ajax({
                url: 'api/update.php',
                type: 'POST',
                data: {
                    id: id,
                    date: date,
                    AM_IN: AM_IN,
                    AM_OUT: AM_OUT,
                    PM_IN: PM_IN,
                    PM_OUT: PM_OUT
                },
                success: (data) => {
                    location.reload();
                }
            });
        });

        // Delete button
        $('.delete').on('click', function() {
            let id = $(this).data('id');

            $.ajax({
                url: 'api/delete.php',
                type: 'POST',
                data: {
                    id: id
                },
                success: (data) => {
                    location.reload();
                }
            });
        });
    })
</script>
</html>