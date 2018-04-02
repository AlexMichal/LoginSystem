<?php
include_once 'includes/dbh.inc.php';

$postNewCount = $_POST['postNewCount'];
$userId = $_POST['userId'];
$sql =  "SELECT message_post, message_timestamp " . 
                "FROM messages " .
                "WHERE message_user_id = '$userId' " .
                "ORDER BY message_timestamp DESC " .
                "LIMIT $postNewCount";
$result = mysqli_query($conn, $sql);

if (!empty($result)) {
    while ($row = mysqli_fetch_array($result)) {
        echo '<div class="row">';
        echo '<div class="col col-md-5 index index_results">';
        echo "<p>" . $row['message_post'] . "</p>";
        echo "<p>" . $row['message_timestamp'] . "</p>";
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "There doesn't seem to be anything here.";
}

mysqli_close($conn); // Close connection to the DB
?>