<?php

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    if (isset($_POST['id']) && $_POST['id'] != "" && isset($_POST['like']) && ($_POST['like'] == "1" || $_POST['like'] == "0" || $_POST['like'] == "-1")) {

        require_once 'dbconnect.php';

        $id = $_POST['id'];
        $like = $_POST['like'];
        $userId = $_SESSION['userid'];


        $conn->query("DELETE FROM like_blog WHERE user='".$userId."' and blog='".$id."';");
        $sql = "INSERT INTO like_blog (liked_disliked, user, blog) VALUES ('".$like."', '".$userId."' , '".$id."')";
        echo $sql;
        if ($conn->query($sql) === TRUE) {
            echo "ok";
        } else {
            echo "nok";
        }
    }
}
?>