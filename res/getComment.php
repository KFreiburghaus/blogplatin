<?php
    if (isset($_GET['id'])) {

        require_once 'dbconnect.php';

        $sql = "SELECT c.*, u.username, u.id as userid FROM comment c JOIN user u ON u.id=c.user where blog=".$_GET['id']." order by c.created desc";
        $result = $conn->query($sql);

        $response = array();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $entry['cid'] = $row['cid'];
                $entry['text'] = $row['text'];
                $entry['username'] = $row['username'];
                $entry['userId'] = $row['userid'];
                $entry['created'] = $row['created'];
                array_push($response, $entry);
            }
        }
        $conn->close();

        header('Content-Type: application/json');
        echo json_encode($response);
    }
?>