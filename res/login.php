<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    if (isset($_POST['email']) && isset($_POST['password'])) {

        require_once 'dbconnect.php';
        $email =  $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM user WHERE email='".$email."' AND password='".$password."'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $_SESSION['loggedin'] = true;
                $_SESSION['userid'] = $row["id"];
                $_SESSION['username'] = $row["username"];

               // header("Location: ../index.php");
               // die();

            }
        } else {
            header("Location: ../login.php?login=fail");
            die();
        }
        $conn->close();
    }
    header("Location: ../login.php");
    die();
}

header("Location: ../login.php");
die();
?>