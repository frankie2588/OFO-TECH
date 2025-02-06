<?php
session_start();
include 'db.php'; // Including the database connection file

$email = $_POST['Email'];
$password = $_POST['password'];

try {
    // SQL to check the existence of user
    $sql = "SELECT UserID, password FROM Login_Tb WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            // Assuming passwords are hashed
            $_SESSION['user_id'] = $row['id'];
            header("Location: welcome.php"); // Redirect to the welcome page
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found with that email address";
    }
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage(); // Log the error for debugging
} finally {
    $stmt->close();
    $conn->close();
}
?>