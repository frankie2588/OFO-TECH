<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define the recipient email address
    $to = "franklinokoth002@gmail.com"; // Replace with your real receiving email address

    // Get form data
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    // Validate form data (you may add more validation here)

    // Build email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Set email headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Attempt to send email
    if (mail($to, $subject, $email_content, $headers)) {
        // Email sent successfully
        echo "OK"; // Return 'OK' to indicate success
    } else {
        // Failed to send email
        http_response_code(500); // Set HTTP status code to 500 (Internal Server Error)
        echo "Failed to send email."; // Return an error message
    }
} else {
    // If the form is not submitted, return an error
    http_response_code(403); // Set HTTP status code to 403 (Forbidden)
    echo "Access Forbidden"; // Return an error message
}

?>
