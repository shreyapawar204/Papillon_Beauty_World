<?php
// 1. Database Connection Details
// We use localhost:3307 because your MySQL Workbench is using port 3306
$servername = "localhost:3307"; 
$username = "root";
$password = ""; // The password you set in my.ini
$dbname = "papillon_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if connection works
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Capture Form Data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // We use real_escape_string to prevent SQL injection (security)
    $u_name    = $conn->real_escape_string($_POST['name']);
    $u_email   = $conn->real_escape_string($_POST['email']);
    $u_mobile  = $conn->real_escape_string($_POST['mobile']);
    $u_gender  = isset($_POST['gender']) ? $_POST['gender'] : "Not Specified";
    $u_message = $conn->real_escape_string($_POST['message']);

    // 3. Insert Data into feedback_tbl
    $sql = "INSERT INTO feedback_tbl (name, email, mobile, gender, message) 
            VALUES ('$u_name', '$u_email', '$u_mobile', '$u_gender', '$u_message')";

    if ($conn->query($sql) === TRUE) {
        // Show success message and go back to feedback page
        echo "<script>
                alert('Feedback submitted successfully!');
                window.location.href='feedback.html';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>