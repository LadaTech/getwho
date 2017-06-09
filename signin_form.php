<?php

include 'config.php';
session_start();

if (isset($_POST['sign_in'])) {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $password = base64_encode(trim($_POST['password']));
    $cpassword = base64_encode(trim($_POST['cpassword']));
    $phonenumber = trim($_POST['phoneno']);
    $address = trim($_POST['address']);
    $query = mysql_query("INSERT INTO users(firstname,lastname,email_id,password,cpassword,mobile,address) values
            ('$firstname','$lastname','$email','$password','$cpassword','$phonenumber','$address');");
    if ($query) {
//    header("Location:signin.php?message=1");
    } else {
//    header("Location:signin.php?message=0");
    }
}

if (isset($_POST['log_in'])) {
    $email = trim($_POST['email']);
    $password = base64_encode(trim($_POST['password']));
    $query = mysql_query("select * from users where email_id like '$email' and password like '$password'");
    $rows = mysql_num_rows($query);   
    if ($rows > 0) {        
        $res = mysql_fetch_object($query);
        $_SESSION['firstname'] = $res->firstname;
        $_SESSION['lastname'] = $res->lastname;
        $_SESSION['email'] = $res->email_id;
        $_SESSION['password'] = $res->password;
        $_SESSION['phoneno'] = $res->mobile;
        $_SESSION['address'] = $res->address;
       header("Location:index.php");
    }
  else{
      header("Location:login.php?message=0");
  }
}
?>
