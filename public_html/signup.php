<?php
    include_once 'header.php';
?>

<section class="main_container">
    <div id="signup_main" class="main_wrapper">
        <!-- Welcome to Facebük -->
        <div id="signup_header">
            <h2><strong>Join Facebük!</strong></h2>
            <p>It's easy.</p>
        </div>

        <form id="signup_form" class="form-group" action="includes/signup.inc.php" method="POST">
            <input type="text" name="first_name" placeholder="first name" class="input form-control" value="TEMP" required>
            <input type="text" name="last_name" placeholder="last name" class="input form-control" value="TEMP" required>
            <input type="text" name="email" placeholder="e-mail" class="input form-control" value="asdf@asdf.com" required>
            <input type="text" name="username" placeholder="username" class="input form-control" required>
            <input type="password" name="password" placeholder="password" class="input form-control" required>
            <small id="signup_error" class="form-text text-alert"></small>
            <button type="submit" name="submit" class="btn btn-primary btn-lg">Sign Up</button>
        </form>
        
        <div id="signup_login_main" class="main_wrapper">
            Have an account already? <a href="">Log in</a>.
        </div>
    </div>
</section>

<?php
    include_once 'footer.php';
?>