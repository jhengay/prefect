<?php 
session_start();
include 'connect.php';

// Sign-Up Logic
if (isset($_POST['signUp'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password); // Hash the password

    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        echo "Email Address Already Exists!";
    } else {
        $insertQuery = "INSERT INTO users (firstName, lastName, email, password)
                        VALUES ('$firstName', '$lastName', '$email', '$password')";
        if ($conn->query($insertQuery) === TRUE) {
            header("Location: index1.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Sign-In Logic
if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Hash the password

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, fetch details
        $user = $result->fetch_assoc();
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $user['firstName']; // Store the firstName as the username in the session

        // Record login time
        $loginQuery = "INSERT INTO user_logs (user_email, login_time) VALUES (?, NOW())";
        $loginStmt = $conn->prepare($loginQuery);
        $loginStmt->bind_param("s", $email);
        $loginStmt->execute();

        header("Location: homepage.php");
        exit();
    } else {
        echo "Not Found, Incorrect Email or Password";
    }
}

// Logout Logic
if (isset($_GET['logout'])) {
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];

        // Update the logout time
        $logoutQuery = "UPDATE user_logs SET logout_time = NOW() WHERE user_email = ? ORDER BY login_time DESC LIMIT 99900000000000000000";
        $stmt = $conn->prepare($logoutQuery);
        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            // Success message (optional)
        } else {
            echo "Error updating logout time: " . $conn->error;
        }
    }

    // Destroy session and redirect to signin page
    session_destroy();
    header("Location: index1.php"); // Replace with the name of your login file
    exit();
}
?>
