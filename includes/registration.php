<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<?php

if (isset($_POST['signup'])) {
    $fname = $_POST['fullname'];
    $email = $_POST['emailid'];
    $mobile = $_POST['mobileno'];
    $password = md5($_POST['password']);
    $sql = "INSERT INTO  tblusers(FullName,EmailId,ContactNo,Password) VALUES(:fname,:email,:mobile,:password)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':fname', $fname, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo "<script>alert('Registration successfull. Now you can login');</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again');</script>";
    }
}

?>

<script>
    $(document).ready(function() {
        otp = Math.floor(Math.random() * 10000);
        console.log('h');
        $("#otp").change(function(e) {
            console.log(e.target.value);
            if (e.target.value == otp) {
                console.log('Otp check complete');
                // $('#otpmessage').innerHTML = "OTP Check complete";
                $('#submit').prop('disabled', false);
            } else {
                $('#otpmessage').innerHTML = "Please Enter a valid OTP";
                $('#submit').prop('disabled', true);
            }
        });

        function test(email) {
            console.log("te");
           
            var pat = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
            if (pat.test(email) == false) {
                alert("Please Enter a valid Email");
                return false;
            }
            return true;
        }
        $('#emailid').change((e) => {
            console.log("changed");
            email = e.target.value

            if (test(email)) {
                $("#otpmessage").html('Sending otp');
                jQuery.ajax({
                    url: "email_otp.php",
                    data: 'emailid=' + email + '&otp=' + otp,
                    type: "GET",
                    success: function(data, n) {
                        console.log(n);
                        console.log("mailed");
                        $("#otpmessage").html('OTP is sent to your email');
                    },
                    error: function() {
                        $("#otpmessage").html('Please enter valid mail');
                    }
                });
            }


        })

    });



    function valid() {
        if (document.signup.password.value != document.signup.confirmpassword.value) {
            alert("Password and Confirm Password Field do not match  !!");

            return false;
        }
        return true;
    }
</script>

<script>
    function checkAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
            data: 'emailid=' + $("#emailid").val(),
            type: "POST",
            success: function(data) {
                $("#user-availability-status").html(data);
                $("#loaderIcon").hide();
            },
            error: function() {}
        });
    }

</script>

<div class="modal fade" id="signupform">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Sign Up</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="signup_wrap">
                        <div class="col-md-12 col-sm-6">
                            <form method="post" name="signup"  autocomplete="off" onSubmit="return valid();">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="fullname" pattern="[a-zA-Z][a-zA-Z ]+[a-zA-Z]$" placeholder="Full Name" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" name="mobileno" placeholder="Mobile Number" pattern="[0-9]{10}" required="required">
                                </div>
                                
                                 <div class="form-group">
                                    <input type="email" class="form-control" name="emailid" id="emailid" onBlur="checkAvailability()" placeholder="Email Address" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[a-z]{2,3}$" required="required">
                                    <span id="user-availability-status" style="font-size:12px;"></span>
                                </div>
                                
                               
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Password(contain A uppercase,A lowercase letter,A number,minimum 8 character)" required="required">
                                </div>
                                
                                <div class="form-group">
                                    <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required="required">
                                </div>
                                
                                <div class="form-group">
                                    <input type="number" class="form-control" id="otp" maxlength=<?php echo 4; ?> name="confirmotp" placeholder="Enter OTP" required="required">
                                </div>
                                <div id="otpmessage">Enter a valid Email to get otp</div>

                                <div class="form-group">
                                    <input type="submit" value="Sign Up" name="signup" id="submit" class="btn btn-block" disabled="true">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <p>Already have an account? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Login Here</a></p>
            </div>
        </div>
    </div>
</div>