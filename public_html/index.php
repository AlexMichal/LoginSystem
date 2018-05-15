<?php
    // phpinfo(); exit;
    include_once 'header.php';
?>
 <!-- jQuery script for loading more posts -->
<script>
    $(document).ready(function() {
        var postCount = 6; 

        $("#butt").click(function() {
            var userId = <?php echo json_encode($_SESSION['u_id']) ?>; // Inject SESSION user id

            postCount = postCount + 2;

            $("#index_posts").load("load-messages.php", {
                postNewCount: postCount,
                userId: userId
            });
        });
    });
</script>
<section class="main_container">
    <div class="container">
        <?php 
        if (isset($_SESSION['u_id'])) { // If logged in then do stuff
            include_once 'includes/dbh.inc.php'; // Open the DB
        ?>
            <div id="index_top" class="display-flex">
                <!-- PROFILE PIC -->
                <div id="index_profile_pic" class="item index flex-none">
                    <a href="uploadimage.php">
                        <div>
                            <?php
                            $userId = $_SESSION['u_id'];
                            $sqlProfileImage = "SELECT status FROM profileimage WHERE user_id = '$userId'";
                            $username = $_SESSION['u_username'];
                            $imagePath = "uploads/" . $username . "/";

                            $sqlQuery = "SELECT * FROM profileimage WHERE user_id='$userId'";
                            $sqlResult = mysqli_query($conn, $sqlQuery);

                            while ($sqlRow = mysqli_fetch_assoc($sqlResult)) {
                                $status = $sqlRow['status'];
                                $filename = $sqlRow['filename'];

                                if ($status == 1) {
                                    echo '<img class="img-wrap" src="' . $imagePath . '/' . $filename . '" alt="Image of User" class="">';  
                                } else {
                                    echo '<img style="" src="assets/defaultprofilepic.png" alt="Default Image of User" class="">';  
                                }
                            }
                            ?>
                        </div>
                    </a>
                </div>
                
                <div id="index_profile_info" class="item flex-auto">
                    <h2>
                    <?php 
                        echo $_SESSION['u_first_name'] . " " . $_SESSION['u_last_name'];;
                    ?>
                    </h2>

                </div>
            </div>

            <!-- SEPARATOR -->
            <hr>

            <!-- POST A NEW MESSAGE -->
            <div class="row">
                <div id="index_message_form" class="col col-md-5.5 index">
                    <form id="message_form" class="form-group" action="includes/post.inc.php" method="POST">
                        <!-- <label for="comment">Comment:</label> -->
                        <textarea id="message" class="form-control" rows="4" name="message" form="message_form"></textarea>
                        <button class="btn" name="submit" type="submit">Post</button>
                    </form>
                </div>

                <!-- FRIENDS LIST -->
                <div id="index_friends_list" class="col col-md-5.5 index">
                    <?php
                    echo 'Friend 1<br />';
                    echo 'Friend 2<br />';
                    echo 'Friend 3<br />';
                    ?>
                </div>
            </div>

            <!-- POSTS (YOURS AND FRIENDS) -->
            <div id="index_posts">
            <?php
                $userId = $_SESSION['u_id'];  
                $sql =  "SELECT message_post, message_timestamp " . 
                        "FROM messages " .
                        "WHERE message_user_id = '$userId' " .
                        "ORDER BY message_timestamp DESC " .
                        "LIMIT 6;";
                $result = mysqli_query($conn, $sql);
                $resultRows = mysqli_num_rows($result);

                mysqli_close($conn); // Close connection to the DB

                if (!$resultRows == 0) {
                    if (!empty($result)) {
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<div class="row">';
                            echo '<div class="col col-md-5 index index_results">';
                            echo "<p>" . $row['message_post'] . "</p>";
                            echo "<p>" . $row['message_timestamp'] . "</p>";
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                    echo '</div>';
                    echo '<button id="butt" class="btn btn-primary">Load More Posts</button>';
                    
                } else {
                    echo "There doesn't seem to be anything here.";
                }
            } else {
                echo "<h4>You are not logged in.</h4>";
            }
        ?>
    </div>
</section>

<?php
    include_once 'footer.php';
?>