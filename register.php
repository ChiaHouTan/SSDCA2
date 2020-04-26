<?php

//register.php

/**
 * Start the session.
 */
session_start();

/**
 * Include ircmaxell's password_compat library.
 */
require 'libary-folder/password.php';

/**
 * Include our MySQL connection.
 */
require 'login_connect.php';


//If the POST var "register" exists (our submit button), then we can
//assume that the user has submitted the registration form.
if(isset($_POST['register'])){
    
    //Retrieve the field values from our registration form.
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $dateOfBirth = !empty($_POST['dateOfBirth']) ? trim($_POST['dateOfBirth']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    
    //TO ADD: Error checking (username characters, password length, etc).
    //Basically, you will need to add your own error checking BEFORE
    //the prepared statement is built and executed.
    
    //Now, we need to check if the supplied username already exists.
    
    //Construct the SQL statement and prepare it.
    $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    
    //Bind the provided username to our prepared statement.
    $stmt->bindValue(':username', $username);
    
    //Execute.
    $stmt->execute();
    
    //Fetch the row.
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If the provided username already exists - display error.
    //TO ADD - Your own method of handling this error. For example purposes,
    //I'm just going to kill the script completely, as error handling is outside
    //the scope of this tutorial.
    if($row['num'] > 0){
        die('That username already exists!');
    }
    
    //Hash the password as we do NOT want to store our passwords in plain text.
    $passwordHash = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
    
    //Prepare our INSERT statement.
    //Remember: We are inserting a new row into our users table.
    $sql = "INSERT INTO users (username, password, dateOfBirth, email) VALUES (:username, :password, :dateOfBirth, :email)";
    $stmt = $pdo->prepare($sql);
    
    //Bind our variables.
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $passwordHash);
    $stmt->bindValue(':dateOfBirth', $dateOfBirth);
    $stmt->bindValue(':email', $email);

    //Execute the statement and insert the new account.
    $result = $stmt->execute();
    
    //If the signup process is successful.
    if($result){
        //What you do here is up to you!
        echo 'Thank you for registering with our website.';

    }
    
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
    </head>
    <link rel="stylesheet" type="text/css" href="Sass/main.css">
    <body class="loginForm">
    <?php include 'header_footer/header.php';?>
    <div class="logCenter">
        <h1>Register</h1>
        <form action="register.php" method="post">
            <label class="logLabel" for="username">Username </label>
            <input class="inputMargin" type="text" id="username" name="username"><br>
            <label class="logLabel" for="password">Password </label>
            <input class="inputMargin" type="text" id="password" name="password" required><br>
            <label class="logLabel" for="passwordConfirm">Password Confirm </label>
            <input class="inputMargin" type="password" placeholder="Confirm Password" id="confirm_password" required><br>
            <label class="logLabel" for="dateOfBirth">Date of Birth </label>
            <input class="inputMargin" type="date" id="dateOfBirth" name="dateOfBirth" required><br>
            <label class="logLabel" for="email">Email </label>
            <input class="inputMargin" type="text" id="email" name="email" 
            pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$" 
            required><br><br>

            <input type="submit" name="register" value="Register"></button>
        </form>

        <p><a href="index.php">Homepage</a></p>

        </div>
        <?php include 'header_footer/footer.php';?>
        <?php
  echo"<script src='javaScript/passwordConfirm.js'></script>";
?>
    </body>
</html>