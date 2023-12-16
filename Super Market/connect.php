<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password']; 
$number = $_POST['number'];
if (empty($fullname)) {
    $error["fullname"] = "Name is required";
    if (empty($email)) {
        $error["email"] = "Email is required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error["email"] = "Invalid email format";
    }

    if (empty($password)) {
        $error["password"] = "Password is required";
    }

    // If there are no errors, register the user
    if (empty($error)) {
        // TODO: Register the user in the database

        // Redirect the user to the success page
        header("Location: connect.php");
    }
// Database connection
$conn = new mysqli('localhost', 'root', ' ', 'test');

if ($conn->connect_error) {
    die('Connection Failed' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO registration (fullname, email, password, number) VALUES (?,?,?,?)");
    $stmt->bind_param("sssi", $fullname, $email, $password, $number);
    $stmt->execute();
    echo"Registration Successfully....";
    $stmt->close();
    $conn->close();
    exit;
}
}

?>
