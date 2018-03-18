
<?php
    include_once 'header.php';

?>
<section class="main_container">
    <div class="main_wrapper">
        <h2>Sign Up</h2>
        <form class="signup_form">
            <input type="text" name="user_first_name" placeholder="Firstname">
            <input type="text" name="user_last_name" placeholder="Lastname">
            <input type="text" name="user_email" placeholder="E-mail">
            <input type="text" name="user_username" placeholder="Username">
            <input type="password" name="user_password" placeholder="Password">
            <button type="submit" name="submit">Sign Up</button>        
        </div>
</section>

<?php
    include_once 'footer.php';
?>
