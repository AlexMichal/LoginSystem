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
                <!-- <textarea class="form-control" rows="5" id="comment" name="message" form="message_form"></textarea> -->
                <input type="text" name="message" class="input form-control">
                <button class="btn" name="submit" type="submit">Post</button>
            </form>

            <!-- POSTS (YOURS AND FRIENDS) -->
            <div class="">
                Posts:
                <?php

                ?>
            </div>
        </div>
    </div>
</section>

<?php
    include_once 'footer.php';
?>