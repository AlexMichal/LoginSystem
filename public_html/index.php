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
            <!-- post a new message area -->
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea class="form-control" rows="5" id="comment"></textarea>
                <button class="btn">Post</button>
            </div>
            <!-- posted messages (friends and yours) sorted alphabetically area -->
            <div class="">
                Posts:
                <?php
                // check if session variable set
                // use the isset function to change any content on any page when a user is logged in
                if (isset($_SESSION['u_id'])) {
                    echo 'Post:' . $_SESSION['u_first_name'];
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php
    include_once 'footer.php';
?>