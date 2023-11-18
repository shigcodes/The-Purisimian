<?php

$con = mysqli_connect('localhost', 'root', 'root', 'db_auth');
if (!$con) {
    die(mysqli_error($con));
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $servername = 'localhost';
    $username = 'root';
    $password = 'root';
    $database = 'db_contact';

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Connection Failed: " . mysqli_connect_error());
    }


    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $sql = "INSERT INTO `users` (`name`, `email`, `phone`) VALUES ('$name', '$email', '$phone')";

        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo 'Entry Successful';
        } else {
            echo 'Error Occurred: ' . mysqli_error($conn);
        }

    }
}

?>