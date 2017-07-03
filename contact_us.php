<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (isset($_POST['sendmessage'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phoneno'];
    $to = 'janibasha@ladatechnologies.com';
    $subject = "CONTACT DETAILS";
    $message = "<html><body><table border=1>"
            . "<tr><td>FirstName:</td><td>"
            . $_POST['name'] . "</td></tr><tr><td>LastName:</td><td>"            
            . $_POST['email'] . "</td></tr></td></tr><tr><td>Phno:</td><td>"
            . $_POST['phoneno'] . "</td></tr></td></tr><tr><td>Message:</td><td>"
            . $_POST['message'] . "</td></tr></table></body></html>";
    $from = trim($_POST['email']);
    $headers='From:'.$from ."\r\n";            
    $headers .= 'X-Mailer: PHP/' . phpversion()."\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $checkEmail = mail($to, $subject, $message, $headers);
    if ($checkEmail) {
        $to_reply = trim($_POST['email']);
        $subject_reply = 'DO NOT REPLY';
        $message_reply = 'Thanks for subscribing.We will get back to you soon..';
        $from_reply = trim('janibasha@ladatechnologies.com');
        $headers = 'From:'. $from_reply . "\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $checkToEmail = mail($to_reply, $subject_reply, $message_reply,$headers);
        if ($checkToEmail) {
            header("location:contact.php?success=1");
        } else {
            echo "error while sending reply mail";
        }
    } else {
        header("location:contact.php?fail=1");
    }
} else {
    header("location:contact.php");
}

