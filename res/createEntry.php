<?php

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    if (isset($_POST['entry']) && $_POST['entry'] != "") {

        require_once 'dbconnect.php';

        $entry = $_POST['entry'];
        $userId = $_SESSION['userid'];

        $sql = "INSERT INTO blog (text, user) VALUES ('".$entry."', '".$userId."')";
        if ($conn->query($sql) === TRUE) {
            header("Location: ../create.php?create=success");
            die();
        } else {
            header("Location: ../create.php?create=fail&message=".$conn->error);
            die();
        }



    }
}
?>