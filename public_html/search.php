<?php
session_start();
 
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // User is NOT logged in → redirect to login page
    header("Location: home.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Search Form</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

  </head>
  <body>
    <div class="form-check">
        <h1>Query 1: Lists all of the inhabitants that live in the dorm with applied search prompt</h1>
        <input type="text" id="search" placeholder="Search...">
        <table id="result">
            <thead>
                <tr>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody>
                <!-- Initial data will be loaded here -->
            </tbody>
        </table>
 
        <script>
            $(document).ready(function () {
                // Load all records initially
                loadAllRecords();
 
                // Perform search
                $('#search').on('keyup', function () {
                    var query = $(this).val();
                    if (query.length > 2) {
                        $.ajax({
                            url: 'searchA.php',
                            type: 'POST',
                            data: { search: query },
                            success: function (data) {
                                $('#result tbody').html(data);
                            }
                        });
                    } else {
                        loadAllRecords();
                    }
                });
 
                function loadAllRecords() {
                    $.ajax({
                        url: 'searchA.php',
                        type: 'POST',
                        data: { search: '' },
                        success: function (data) {
                            $('#result tbody').html(data);
                        }
                    });
                }
            });
        </script>
    </div>
  </body>
</html>