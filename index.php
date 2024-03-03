<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the field values from the form
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];

    // Prepare the SQL statement
    $sql = "INSERT INTO mytable (firstname, lastname) VALUES ('$firstName', '$lastName')";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully.";

        // Send email using PHPMailer
        $to = "recipient@example.com";
        $subject = "New data submitted";
        $message = "A new record has been submitted:\n\nFirst Name: $firstName\nLast Name: $lastName";

        // Configure PHPMailer
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@example.com'; // SMTP username
        $mail->Password = 'your-password'; // SMTP password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('sender@example.com', 'Sender Name');
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $message;

        if ($mail->send()) {
            echo "Email sent successfully.";
        } else {
            echo "Failed to send email. Error: " . $mail->ErrorInfo;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
