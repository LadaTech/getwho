
<?PHP include_once('header.php');
session_start();
?><!-- Hero Section -->


<div class="service-area inner-padding7">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12"></div>
            <div class="col-md-4 col-sm-12 col-xs-12 well">
                <?php
                if((isset($_GET['message'])) && ($_GET['message'] == 0)){
                     echo "<font color=red>You have entered wrong email id and password</font>";
                }
                ?>
                <h3>Log in to Get Who is</h3>
                <form id="login" name="login" method="post" enctype="multipart/form-data" action="signin_form.php">
                    <div class="form-group">
                        <label for="Email">Email address</label>
                        <input type="email" class="form-control" id="Email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="password">
                    </div>    
                    <div class="forgot">
                        <label>
                            <a href="#">Forgot Password?</a>
                        </label>
                    </div>
                    <button type="submit" id="log_in" name="log_in" class="btn btn-default">submit</button>
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
                                    $(document).ready(function () {        
                                        $("#login").validate({
                                            rules: {
                                                email: {
                                                    required: true,
                                                    email: true
                                                },
                                                password: {
                                                    required: true
                                                }
                                            },
                                            messages: {
                                                email: {
                                                    required: "Please Enter Your Contact Email",
                                                    email: "Enter Correct Email Id "
                                                },
                                                password: {
                                                    required: "Please Provide Password"
                                                }

                                            },
                                        });
                                    })
</script>