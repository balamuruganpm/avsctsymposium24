<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            padding: 20px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .data-table th {
            background-color: #f2f2f2;
        }

        .no-records {
            text-align: center;
            color: #666;
            font-style: italic;
        }
    </style>

    <link rel="stylesheet" href="../bootstrap.min.css">

    <!--  bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>

<body>

    <div class="main">
        <h1>Welcome to Admin Dashboard</h1>

        <h2>Registration Data:</h2>

        <?php
        // Connect to your database
        $servername = "sql201.infinityfree.com";
        $username = "if0_35617097";
        $password = "xoPZGKvogmQ3qT";
        $database = "if0_35617097_hari";
        $port = 3306;

        $conn = new mysqli($servername, $username, $password, $database, $port);

        // Check connection
        if ($conn->connect_error) {
            die ("Connection failed: " . $conn->connect_error);
        }

        // Fetch data from the database
        $sql = "SELECT * FROM agriregister";
        $result = $conn->query($sql);

        // Display data in a table
        if ($result->num_rows > 0) {
            echo "<table class='data-table table-bordered table-hover table-responsive'>
    <thead>
        <tr>
            <th>ID</th>
            <th style='text-align: center;'>Full Name</th>
            <th style='text-align: center;'>Email</th>
            <th style='text-align: center;'>Phone Number</th>
            <th style='text-align: center;'>Date of Birth</th>
            <th style='text-align: center;'>Gender</th>
            <th style='text-align: center;'>WhatsApp Number</th>
            <th style='text-align: center;'>College</th>
            <th style='text-align: center;'>Department</th>
            <th style='text-align: center;'>Year of Study</th>
            <th style='text-align: center;'>Technical Event</th>
            <th style='text-align: center;'>Non-Technical Event</th>
        </tr>
    </thead>
    <tbody>";

            // Output data rows
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
        <td style='text-align: center;'>" . $row["id"] . "</td>
        <td style='text-align: center;'>" . $row["full_name"] . "</td>
        <td style='text-align: center;'>" . $row["email"] . "</td>
        <td style='text-align: center;'>" . $row["phone_number"] . "</td>
        <td style='text-align: center;'>" . $row["dob"] . "</td>
        <td style='text-align: center;'>" . $row["gender"] . "</td>
        <td style='text-align: center;'>" . $row["whatsapp_number"] . "</td>
        <td style='text-align: center;'>" . $row["college"] . "</td>
        <td style='text-align: center;'>" . $row["department"] . "</td>
        <td style='text-align: center;'>" . $row["year_of_study"] . "</td>
        <td style='text-align: center;'>" . $row["technical_event"] . "</td>
        <td style='text-align: center;'>" . $row["non_technical_event"] . "</td>
    </tr>";
            }

            echo "</tbody></table>";

            echo "<br>";

            // Add a button for downloading the CSV file
            echo "<form action='export.php' method='post'>
    <input type='submit' name='export_csv' value='Export CSV'>
  </form>";

        } else {
            echo "<p class='no-records'>No records found</p>";
        }
        // Close the database connection
        $conn->close();
        ?>
    </div>

    <!-- js file -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

</body>

</html>