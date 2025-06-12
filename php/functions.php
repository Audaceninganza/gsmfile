<?php
include 'config.php';
$db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die("database is not connected");


//function for showing pages
function showPage($page,$data=""){
include("parts/$page.php");
}

//function for show prevformdata
function showFormData($field){
    if(isset($_SESSION['formdata'])){
        $formdata =$_SESSION['formdata'];
        return $formdata[$field];
    }
 
}

//for validating the signup form
function validateSignupForm($form_data){
    $response=array();
    $response['status']=true;
  
        if(!$form_data['email']){
            $response['msg']="email is not given";
            $response['status']=false;
            $response['field']='email';
        }
        
        if(!$form_data['password']){
            $response['msg']="password is not given";
            $response['status']=false;
            $response['field']='password';
        }
       
        if(isEmailRegistered($form_data['email'])){
            $response['msg']="email id is already registered";
            $response['status']=false;
            $response['field']='email';
        }
         
    
        return $response;
    
    }

    //for checking duplicate email
function isEmailRegistered($email){
    global $db;
    $query="SELECT count(*) as row FROM users WHERE email='$email'";
    $run=mysqli_query($db,$query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}

    //function for show errors
    function showError($field){
        if(isset($_SESSION['error'])){
            $error = $_SESSION['error'];
            // Display error if the current field matches the error field
            if(isset($error['field']) && ($field == $error['field'] || $error['field'] == 'checkuser')){
                ?>
               <div style="background-color: #f8d7da; border-left: 5px solid #f44336; border-radius: 5px; padding: 10px; color: #721c24; font-family: Arial, sans-serif; margin-top: 10px; display: flex; align-items: center;">
                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 10px; color: #f44336;">
                 <path d="M8.982 1.566a1.5 1.5 0 0 1 2.036 0l6.364 5.654A1.5 1.5 0 0 1 17.5 9.2v6.6a1.5 1.5 0 0 1-1.5 1.5H1.5A1.5 1.5 0 0 1 0 15.8V9.2a1.5 1.5 0 0 1 .618-1.19l6.364-5.654zM8 3.528L2.386 8.8v6.2h11.228V8.8L8 3.528z"/>
    </svg>
    <span>
        <?= $error['msg'] ?>
    </span>
</div>
                <?php
            }
        }
    }
    

   // Function to create a new user and add an entry to the payments table
function createUser($data) {
    global $db;

    // Sanitize and hash inputs
    $email = mysqli_real_escape_string($db, $data['email']);
    $password = mysqli_real_escape_string($db, $data['password']);
    $hashedPassword = md5($password);

    // Start a transaction
    mysqli_begin_transaction($db);

    try {
        // Insert user data into the `users` table
        $userQuery = "INSERT INTO users (email, password) VALUES ('$email', '$hashedPassword')";
        if (!mysqli_query($db, $userQuery)) {
            throw new Exception("User insertion failed: " . mysqli_error($db));
        }

        // Retrieve the newly inserted user ID
        $userId = mysqli_insert_id($db);

        // Insert initial entry into the `payments` table
        $paymentQuery = "INSERT INTO payments (user_id, file_id, payment_status) VALUES ('$userId', 0, 'pending')";
        if (!mysqli_query($db, $paymentQuery)) {
            throw new Exception("Payment record insertion failed: " . mysqli_error($db));
        }

        // Commit the transaction
        mysqli_commit($db);
        return true;

    } catch (Exception $e) {
        // Roll back the transaction on error
        mysqli_rollback($db);
        error_log($e->getMessage()); // Log the error for debugging
        return false;
    }
}



//for validating the signup form
function validateLoginForm($form_data){
    $response = array();
    $response['status'] = true;
    $blank = false;
    
    if(!$form_data['password']){
        $response['msg']="password is not given";
        $response['status']=false;
        $response['field']='password';
        $blank=true;
    }

    if(!$form_data['email']){
        $response['msg'] = "email is not given";
        $response['status'] = false;
        $response['field'] = 'email';
        $blank=true;

    }
        
    
    // if(!$blank){
    //     $user_data = checkUser($form_data);
    //     if(!$user_data['status']){
    //         $response['msg'] = "something is incorrect, we can't find you";
    //         $response['status'] = false;
    //         $response['field'] = 'checkuser';
    //     } else {
    //         $response['user'] = $user_data['user'];
    //     }
    // }
    if(!$blank && !checkUser($form_data)['status'] ){
        $response['msg']="something is incorrect, we can't find you";
        $response['status']=false;
        $response['field']='checkuser';
    }else{
        $response['user']=checkUser($form_data)['user'];
    }

    return $response;
}

//for checking the user
function checkUser($login_data){
    global $db;
 $email = $login_data['email'];
 $password=md5($login_data['password']);

 $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
 $run = mysqli_query($db,$query);
 $data['user'] = mysqli_fetch_assoc($run)??array();
 if(count($data['user'])>0){
     $data['status']=true;
 }else{
    $data['status']=false;

 }

 return $data;
}

function getUser($user_id){
    global $db;
 $query = "SELECT * FROM users WHERE user_id='$user_id'";
 $run = mysqli_query($db,$query);
 return mysqli_fetch_assoc($run);
}

//function for verify email
function verifyEmail($email){
    global $db;
    $query="UPDATE users SET mail_verify=1 WHERE email='$email'";
    return mysqli_query($db,$query);
}


?>