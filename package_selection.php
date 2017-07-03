<?PHP
 include_once('header.php');
$package_type = $_REQUEST['type'];
?>

<!-- Hero Section -->

<!--<div class="contact">
    <div class="container inner-padding7" style="margin-top:100px;">       
        <div class="row">
            <h3>Your Are Selected <?PHP echo $package_type ?> Package </br>Please Fill The Following Details</h3>
            <div class="col-md-4 col-sm-12 col-xs-12">                
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12 well">
                <h3>Your Choosen <?PHP // echo $package_type ?> Please Fill The Following Details</h3>
                <h3>Contact US</h3>
                <?php
                if (isset($_GET['success'])) {
                    echo "<font color=green>thanks for contacting us<br>we will get back soon...</font>";
                }
                if (isset($_GET['fail'])) {
                    echo "<font color=red>Check the mail..may be some thig is missig..</font>";
                }
                ?>
                <form id="contactUsForm" name="contactUsForm" class="cmxform" method="post" action="contact_us.php">                    
                    <div class="form-group col-md-6">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="firstname" name="name" placeholder="name">
                    </div>                    
                    <div class="form-group col-md-6">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phoneno">Phone Number </label>
                        <input type="text" class="form-control" id="phoneno" name="phoneno"  placeholder="Phone Number">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputPassword1">Message</label>
                        <textarea class="form-control" rows="2" id="message" name="message" placeholder="Message"></textarea>
                    </div>
                    <input class="submit btn btn-theme"  id="sendmessage" name="sendmessage" type="submit" value="Send Message">
                </form>
            </div>
        </div>


    </div>

</div>

 End Service Section 

<?php include_once('footer.php') ?>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
//        alert('praveen');
        $("#contactUsForm").validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
//                    customeemail: true
                },
                phoneno: {
                    required: true,
                    number: true,
                    maxlength: 10,
                    minlength: 10
                },
                message: "required"
            },
            messages: {
                name: "please enter firstname",
                email: {
                    required: "pelase enter email",
                    email: "please enter correct email"
//                    customemail:"plaese enter valid email"                    
                },
                phoneno: {
                    required: "please enter mobile number",
                    maxlength: "Please enter valid Phone number",
                    minlength: "Please enter valid Phone number"
                },
                message: "please enter some text"
            },
        });
    })
</script>-->

