<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$data['page_title']?></title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login_card">
        <div class="login_container">
            <img src="assets/images/AI21.png" alt="logo" width="50" height="50">
            <div class="login_title">
                <h1>SignUp</h1>
            </div>
            <form action="php/actions.php?signup" method="post" class="form1">
                <div class="input">
                    <label for="email">Email:</label>
                    <input type="email" value="<?=showFormData('email')?>" name="email" id="email" autocomplete="off" placeholder="john@gmail.com">
                </div>
                <?=showError('email')?>
                <div class="input">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" placeholder="enter password" autocomplete="off" >
                </div>
                 
                <?=showError('password')?>
                <div class="forget">
                    <span>Already have an account? <a href="?">SignIn</a></span>
                </div>
                <input type="submit" value="SignUp">
            </form>
        </div>
    </div>    
 </body>
</html>

