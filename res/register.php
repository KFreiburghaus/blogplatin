<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    if (isset($_POST['email']) && isset($_POST['password'])  && isset($_POST['username'])) {


        require_once 'dbconnect.php';
        $email =  $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM user WHERE email='".$email."' OR username='".$username."'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                header("Location: ../register.php?register=fail");
                die();
            }
        } else {

            $sql = "INSERT INTO user (username, email, password) VALUES ('".$username."', '".$email."', '".$password."')";
            if ($conn->query($sql) === TRUE) {
                header("Location: ../register.php?register=success");
                die();
            } else {
                header("Location: ../register.php?register=fail&message=".$conn->error);
                die();
            }
        }
        $conn->close();
    }
    header("Location: ../register.php");
    die();
}

header("Location: ../register.php");
die();
?>