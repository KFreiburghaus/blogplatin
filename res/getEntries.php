<?php
    require_once 'dbconnect.php';
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $sql = "SELECT b.*, u.username as blogcreator, u.id as blogcreatorid,
                (select count(*) from comment where blog=b.bid) as commentcount, 
                (select count(*) from like_blog where blog=b.bid and liked_disliked = 1) as likes, 
                (select count(*) from like_blog where blog=b.bid and liked_disliked = -1) as dislikes,
                (select liked_disliked from like_blog where blog=b.bid and user='".$_SESSION['userid']."') as myAction 
            FROM blog b 
            JOIN user u ON u.id=b.user 
            order by created desc";

} else {
    $sql = "SELECT b.*, u.username as blogcreator, u.id as blogcreatorid,
                (select count(*) from comment where blog=b.bid) as commentcount, 
                (select count(*) from like_blog where blog=b.bid and liked_disliked = 1) as likes, 
                (select count(*) from like_blog where blog=b.bid and liked_disliked = -1) as dislikes
            FROM blog b 
            JOIN user u ON u.id=b.user 
            order by created desc";
}

    $result = $conn->query($sql);

    $response = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                $entry['myAction'] = $row['myAction'];
            }

            $entry['blogcreatorid'] = $row['blogcreatorid'];
            $entry['bid'] = $row['bid'];
            $entry['text'] = $row['text'];
            $entry['blogcreator'] = $row['blogcreator'];
            $entry['created'] = $row['created'];
            $entry['commentcount'] = $row['commentcount'];
            $entry['likes'] = $row['likes'];
            $entry['dislikes'] = $row['dislikes'];
            array_push($response, $entry);
        }
    }
    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($response);

?>