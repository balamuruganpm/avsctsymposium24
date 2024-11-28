<?php
// Database connection
$servername = "sql201.infinityfree.net";
$username = "if0_35617097";
$password = "xoPZGKvogmQ3qT";
$database = "if0_35617097_hari";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $database, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT * FROM agriregister";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Set headers to force download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="registration_data.csv"');

    // Open file handle to write CSV data
    $output = fopen('php://output', 'w');

    // Write CSV headers
    fputcsv($output, array('ID', 'Full Name', 'Email', 'Phone Number'));

    // Write data rows
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }

    // Close file handle
    fclose($output);
} else {
    echo "No records found";
}

// Close the database connection
$conn->close();
?>
