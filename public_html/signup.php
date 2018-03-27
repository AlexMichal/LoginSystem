<?php
    include_once 'header.php';
?>

<section class="main_container">
    <div class="main_wrapper">
        <h2>Sign Up</h2>
        
        <form class="signup_form" action="includes/signup.inc.php" method="POST">
            <input type="text" name="first_name" placeholder="First name" class="input">
            <input type="text" name="last_name" placeholder="Last name" class="input">
            <input type="text" name="email" placeholder="E-mail" class="input">
            <input type="text" name="username" placeholder="Username" class="input">
            <input type="password" name="password" placeholder="Password" class="input">
            <button type="submit" name="submit" class="input">Sign Up</button>
        </form>
    </div>
</section>

<?php
    include_once 'footer.php';
?>