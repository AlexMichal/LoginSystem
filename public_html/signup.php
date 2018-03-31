<?php
    include_once 'header.php';
?>

<section class="main_container">
    <div id="signup_main" class="main_wrapper">
        <!-- TODO use an object -->
        <form id="signup_form" class="form-group" action="includes/signup.inc.php" method="POST">
            <input type="text" name="first_name" placeholder="First name" class="input form-control">
            <input type="text" name="last_name" placeholder="Last name" class="input form-control">
            <input type="text" name="email" placeholder="E-mail" class="input form-control">
            <input type="text" name="username" placeholder="Username" class="input form-control">
            <input type="password" name="password" placeholder="Password" class="input form-control">
            <small id="signup_error" class="form-text text-alert">asdasd</small>
            <button type="submit" name="submit" class="input form-control">Sign Up</button>
        </form>
        
        <div id="signup_login_main" class="main_wrapper">
            Have an account already? Log in.
        </div>
    </div>
</section>

<?php
    include_once 'footer.php';
?>