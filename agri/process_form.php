<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Required form fields
    $requiredFields = ['to_name', 'emailAddress', 'phoneNumber', 'birthdayDate', 'whatsappNumber', 'collegename', 'department', 'yearofstudy'];

    $missingFields = [];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
            $missingFields[] = $field;
        }
    }

    if (!empty($missingFields)) {
        // Handle missing fields here
        echo "<script>alert('Please fill in all required fields: " . implode(", ", $missingFields) . "');</script>";
    } else {

        $config = include('../store/sffb.php');
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['database'], $config['port']);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement for data insertion
        $stmt = $conn->prepare("INSERT INTO agriregister (full_name, email, phone_number, dob, gender, whatsapp_number, college, department, year_of_study, technical_event, non_technical_event, pptFile) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssssssssssss", $full_name, $email, $phone_number, $dob, $gender, $whatsapp_number, $college, $department, $year_of_study, $technical_event, $non_technical_event, $ppt_file);

        // Assign form data to variables
        $full_name = $_POST['to_name'];
        $email = $_POST['emailAddress'];
        $phone_number = $_POST['phoneNumber'];
        $dob = $_POST['birthdayDate'];
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
        $whatsapp_number = $_POST['whatsappNumber'];
        $college = $_POST['collegename'];
        $department = $_POST['department'];
        $year_of_study = $_POST['yearofstudy'];
        //$technical_event = isset($_POST['technical']) ? $_POST['technical'] : '';
        $technical_event = ""; 
		foreach($_POST['technical'] as $selected) { 
		// Here $results holding all the check box values as a string 
		$technical_event .= $selected ." , ";	 
		//if you need space for each value use $results .= $selected . " "; 
		} 
        $non_technical_event = "";
        foreach($_POST['nontechnical'] as $selected) { 
		// Here $results holding all the check box values as a string 
		$non_technical_event .= $selected ." , ";	 
		//if you need space for each value use $results .= $selected . " "; 
		} 
        $ppt_file = ''; // Set default value

       

        // Check if a file was uploaded
        if (isset($_FILES['pptFile']) && $_FILES['pptFile']['error'] !== UPLOAD_ERR_NO_FILE) {
            // Handle file upload
            $allowedExtensions = ['ppt', 'pptx', 'pdf'];
            $fileExtension = pathinfo($_FILES['pptFile']['name'], PATHINFO_EXTENSION);

            if (in_array($fileExtension, $allowedExtensions)) {
                $fileTmpPath = $_FILES['pptFile']['tmp_name'];
                $fileName = $_FILES['pptFile']['name'];
                $targetDirectory = 'uploads/';
                $targetFilePath = $targetDirectory . $fileName;

                // Move uploaded file to a directory on the server
                if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
                    $ppt_file = $targetFilePath;
                } else {
                    echo "<script>alert('Error uploading the file.');</script>";
                }
            } else {
                echo "<script>alert('File type not allowed. Please upload a PPT, PPTX, or PDF file.');</script>";
            }
        }

        // Execute the query after processing the file upload
        if ($stmt->execute()) {
            echo "<script>alert('Thanks for Registration.');</script>";
        } else {
            // Handle database insertion error
            echo "<script>alert('Error inserting data: " . $stmt->error . "');</script>";
            error_log("Error inserting data: " . $stmt->error); // Log the error for internal review

        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>
