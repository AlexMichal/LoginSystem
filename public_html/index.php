<?php
    include_once 'header.php';
?>

<section class="main_container">
    <div class="main_wrapper container">
        <div class="row">
            <?php
            // check if session variable set
            // use the isset function to change any content on any page when a user is logged in
            if (isset($_SESSION['u_id'])) {
                echo 'Welcome back, ' . $_SESSION['u_first_name'];
            }
            ?>

            <!-- POST A NEW MESSAGE -->
            <form id="message_form" class="form-group" action="includes/post.inc.php" method="POST">
                <!-- <label for="comment">Comment:</label> -->
                <textarea id="message" class="form-control" rows="5"name="message" form="message_form"></textarea>
                <!-- <input type="text" name="message" class="input form-control"> -->
                <button class="btn" name="submit" type="submit">Post</button>
            </form>

            <!-- POSTS (YOURS AND FRIENDS) -->
            <div class="">
                Posts:<br />
                <?php 
                if (isset($_SESSION['u_id'])) {
                    include_once 'includes/dbh.inc.php';

                    // query the latest message
                    $userId = $_SESSION['u_id'];
                    // $sql =  "SELECT message_post" .
                    //         "FROM messages" .
                    //         "WHERE message_user_id = '9';";
                            
                    $sql = "SELECT message_post FROM messages WHERE message_user_id = ' $userId ';";
                    $result = mysqli_query($conn, $sql);
                   
                    
                    echo mysqli_num_rows($result);

                    if (!empty($result)) {
                        while ($row = mysqli_fetch_array($result)) {
                            echo $row[0] . "<br />";
                        }
                    }
                } else {
                    echo "There doesn't seem to be anything here.";
                }

                mysqli_close($conn); // Close connection to the DB
                ?>
            </div>
        </div>
    </div>
</section>

<?php
    include_once 'footer.php';
?>