
<?PHP
include_once('header.php');
session_start();
?>
<!-- Hero Section -->


<div class="service-area inner-padding5">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-12 col-xs-12"></div>
            <div class="col-md-8 col-sm-12 col-xs-12 well">
                <div class="something">

                    <?php
//                     echo "Your Message successfully sent, we will get back to you ASAP.";
                    if ((isset($_GET['message'])) && ($_GET['message'] == 1 )) {
                        echo "<font color=green>You have registered successfully</font>";
                    }
                    if ((isset($_GET['message'])) && ($_GET['message'] == 0 )) {
                        echo "<font color=red>error while registering</font>";
                    }
                    ?>
                    <h3>Register to Get Who is</h3>
                    <form id="signin" class="form-horizontal" name="signin" method="post" enctype="multipart/form-data" action="signin_form.php">
                        <div class="form-group">
                            <label for="FirstName" class="col-sm-2 control-label"> First Name</label>
                            <div class="col-sm-4">
                            <input type="text" class="form-control" id="firstname"  name="firstname" placeholder="firstname">
                            </div>
                         
                            <label for="LastName" class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-4">
                            <input type="text" class="form-control" id="lastname"  name="lastname"placeholder="lastname">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Email" class="col-sm-2 control-label">Email address</label>
                            <div class="col-sm-4">
                            <input type="email" class="form-control" id="Email" name="email" placeholder="Email">
                            </div>
                            <label for="Email" class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-4">
                            <input type="email" class="form-control" id="Phone Number" name="Phone Number" placeholder="Phone Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-4">
                            <input type="password" class="form-control" id="password" name="password" placeholder="password">
                            </div>
                            <label for="cpassword" class="col-sm-2 control-label">confirm PassWord</label>
                            <div class="col-sm-4">
                            <input type="password" class="form-control" id="cpassword" name="cpassword"placeholder="confirm password">
                            </div>
                        </div>
                                         
                        <!-- <div class="form-group">
                            <label for="address" class="col-sm-2 control-label">Address:</label>
                            <div class="col-sm-8">
                            <textarea name="address" id="address" rows="3" cols="70"></textarea>
                            </div>
                        </div> -->
 
                        <!--<input type="submit" id="sign_in" name="sign_in" class="btn btn-default" value="submit">-->
                        <button type="submit" id="sign_in" name="sign_in" class="btn btn-default">submit</button>
                        <div id="error_message" class="ajax_response" style="float:left"></div>
                        <div id="success_message" class="ajax_response" style="float:left"></div>
                        <div class="form-group">
                            <div class="col-md-12 control">
                                <div style="border-top: 1px solid#888; margin-top:15px; font-size:85%" >
                                    Don't have an account! 
                                    <a href="#" onClick="$('#loginbox').hide();
                                            $('#signupbox').show()">
                                        Sign Up Here
                                    </a>
                                </div>
                            </div>
                        </div> 
                    </form>
                     
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Service Section -->



<!-- End Service Section -->

<?php include_once('footer.php') ?>

<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type='text/javascript' src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js"></script>
<script type='text/javascript' src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/additional-methods.js"></script>

<script type="text/javascript">
                                        $(document).ready(function () {//        
                                            $("#signin").validate({
                                                rules: {
                                                    firstname: {
                                                        required: true
                                                    },
                                                    lastname: {
                                                        required: true
                                                    },
                                                    email: {
                                                        required: true,
                                                        email: true,
                                                        customemail: true
                                                    },
                                                    password: {
                                                        required: true,
                                                        custompass: true
                                                    },
                                                    cpassword: {
                                                        equalTo: '#password',
                                                        minlength: 5
                                                    },
                                                    phoneno: {
                                                        required: true,
                                                        number: true,
                                                        maxlength: 10,
                                                        minlength: 10
                                                    },
                                                    address: "required"
                                                },
                                                messages: {
                                                    firstname: "please enter firstname",
                                                    lastname: "please enter lastname",
                                                    email: {
                                                        required: "Please Enter Your Contact Email",
                                                        email: "Enter Correct Email Id ",
                                                        customemail: "Enter Valid Email"
                                                    },
                                                    password: {
                                                        required: "Please Provide Password",
                                                        custompass: "your password should least one number, one lowercase,one uppercase letter and minimum 6 letters"
                                                    },
                                                    cpassword: {
                                                        equalTo: "password and confirm password should be same"
                                                    },
                                                    phoneno: {
                                                        required: "please enter mobile number",
                                                        maxlength: "Please enter valid Phone number",
                                                        minlength: "Please enter valid Phone number"
                                                    },
                                                    address: "please enter address"
                                                },
                                            });
                                        })

                                        $(document).ready(function () {

                                            $.validator.addMethod('customemail', function (value, element) {
                                                var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                                                return re.test(value);
                                            },
                                                    'Sorry, I`ve enabled very strict email validation'
                                                    );
                                            $.validator.addMethod('custompass', function (value, element) {
                                                var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
                                                return re.test(value);
                                            },
                                                    'Sorry, I`ve enabled very strict password validation'
                                                    );
                                        });
//                                        $("#signin").submit(function () {
//                                            alert("hi");
//                                            var firstname = $("#firstname").val();
//                                            var lastname = $("#lastname").val();
//                                            var email = $("#email").val();
//                                            var password = $("#password").val();
//                                            var cpassword = $("#cpassword").val();
//                                            var phoneno = $("#phoneno").val();
//                                            var address = $("#address").val();
//                                            var url = "signin.php"; // the script where you handle the form input.
//
//                                            $.ajax({
//                                                type: "POST",
//                                                url: url,
//                                                // serialize your form's elements.
////                                                data: $("#signin").serialize(),
//                                                data:"firstname="+firstname+"&lastname="+lastname+"&email="+email+"&password="+password+"&cpassword="+cpassword+"&phoneno="+phoneno+"&address="+address,
//                                                        success: function (data)
//                                                        {
//                                                            // "something" is the class of your form wrapper
//                                                            $('.something').html(data);
//                                                            $('#success_message').fadeIn().html(data);
//                                                        }
//                                            });
//                                            // avoid to execute the actual submit of the form.
//                                            return false;
//                                        });
</script>
