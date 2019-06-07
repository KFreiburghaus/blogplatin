<?php

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    if (isset($_POST['id']) && $_POST['id'] != "" && isset($_POST['comment']) && $_POST['comment'] != "") {

        require_once 'dbconnect.php';

        $id = $_POST['id'];
        $comment = $_POST['comment'];
        $userId = $_SESSION['userid'];

        $sql = "INSERT INTO comment (text, blog, user) VALUES ('".$comment."', '".$id."' , '".$userId."')";
        if ($conn->query($sql) === TRUE) {
            echo "ok";
        } else {
            echo "nok";
        }
    }
}
?>