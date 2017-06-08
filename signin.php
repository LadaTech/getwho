
<?PHP include_once('header.php'); ?>
<!-- Hero Section -->


<div class="service-area inner-padding7">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12"></div>
            <div class="col-md-4 col-sm-12 col-xs-12 well">
                <h3>Log in to Get Who is</h3>
                <form id="signin" name="signin" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="FirstName"> First Name</label>
                        <input type="text" class="form-control" id="firstname"  name="firstname" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="LastName">Last Name</label>
                        <input type="text" class="form-control" id="lastname"  name="lastname"placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="Email">Email address</label>
                        <input type="email" class="form-control" id="Email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="password">
                    </div>                   
                    <div class="form-group">
                        <label for="cpassword">confirm PassWord</label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword"placeholder="confirm password">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control" id="phoneno" name="phoneno" placeholder="phone number">
                    </div>                    
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea name="address" id="address" rows="3" cols="35"></textarea>
                    </div>

                    <div class="forgot">
                        <label>
                            <a href="#">Forgot Password?</a>
                        </label>
                    </div>
                    <button type="submit" id="sign_in" name="sign_in" class="btn btn-default">Submit</button><Br> 
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
                                                cpassword:{
                                                   equalTo:"password and confirm password should be same" 
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
</script>