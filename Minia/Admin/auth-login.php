<?php
 

# Start the session
session_start();

        

// Check if the user is already logged in, if yes then redirect him to index page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    // echo "<script>console.log(".session_status().")<?script>";
    exit;
}



// Include config file
require_once "layouts/config.php";
// echo "<script>alert('out session')</script>";
// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if email is empty
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    
    // Validate credentials
    if (empty($email_err) && empty($password_err)) {
        

        $sql = "SELECT concat(MILJON_EMPLOYEE.LST_NAME, ' ', MILJON_EMPLOYEE.FST_NAME) AS username,MILJON_EMPLOYEE.MEMPLOYEE_ID   FROM MILJON_EMPLOYEE WHERE email = '".$email."' AND password = '".$password."'";
        
        $result = mysqli_query($link, $sql);
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

             $user_id =  $row['username'];
             $u_id =  $row['MEMPLOYEE_ID'];


          }
        $_SESSION['samplename']=$user_id ; // Session Set
        $_SESSION['user_id']=$u_id ; // Session Set

        if($u_id =='MEMP_G_16' || $u_id =='MEMP_G_57' || $u_id =='MEMP_G_89'){
            $_SESSION['user_id']='MEMP_G_1' ; // Session Set
            $_SESSION['is_admin']= true ;
            $_SESSION['admin_id'] = $u_id;

        }else $_SESSION['is_admin'] = false ;

        if ($stmt = mysqli_prepare($link, $sql)) {
            
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = $email;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if email exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    
                    // Bind result variables
                    $id = 'MEMP_T_1';
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    // echo "<script>console.log('check4')</script>";
                    $pass = "SELECT PASSWORD FROM MILJON_EMPLOYEE where MEMPLOYEE_ID = '".$u_id."'";
                    
                    // if (mysqli_stmt_fetch($stmt)) {
                        // if ($password == $pass) {
                            
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;

                            // Redirect user to welcome page
                            include("global.php");
                            header("location: index.php");

                        // } else {
                        //     // Display an error message if password is not valid
                        //     $password_err = "The password you entered was not valid.";
                        // }
                    // }
                } else {
                    // Display an error message if email doesn't exist
                    echo "<script>alert('Email or Password is incorrect. Please try again.')</script>";
                    // $email_err = "No account found with that email.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Login | Mediola</title>
    <?php include 'layouts/head.php'; ?>

    <?php include 'layouts/head-style.php'; ?>

</head>

<?php include 'layouts/body.php'; ?>
<div class="auth-page">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-xxl-3 col-lg-4 col-md-5">
                <div class="auth-full-page-content d-flex p-sm-5 p-4">
                    <div class="w-100">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-4 mb-md-5 text-center">
                                <a href="index.php" class="d-block auth-logo">
                                    <img src="assets/images/mediola/circle-logo.svg" alt="" height="28"> <span class="logo-txt">Mediola</span>
                                </a>
                            </div>
                            <div class="auth-content my-auto">
                                <div class="text-center mb-5">
                                    <h5 class="mb-0">Welcome Back !</h5>
                                    <p class="text-muted mt-2">Sign in to continue to Mediola.</p>
                                </div>

                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item ">
                                        <a class="nav-link" href="https://gufic.globalspace.in/billing/auth-login.php" role="tab">
                                            <span>Billing</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="https://gufic.globalspace.in/sparsh/auth-login.php" role="tab">
                                            <spa>Sparsh</span>
                                        </a>
                                    </li>
                                </ul>


                                <form class="custom-form mt-4 pt-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <div class="mb-3 <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" value="">
                                        <span class="text-danger"><?php echo $email_err; ?></span>
                                    </div>
                                    <div class="mb-3 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-grow-1">
                                                <label class="form-label" for="password">Password</label>
                                            </div>
                                            <!-- <div class="flex-shrink-0">
                                                <div class="">
                                                    <a href="auth-recoverpw.php" class="text-muted">Forgot password?</a>
                                                    <a href="#" class="text-muted">Forgot password?</a>
                                                </div>
                                            </div> -->
                                        </div>

                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" placeholder="Enter password" name="password" value="" aria-label="Password" aria-describedby="password-addon">
                                            <button class="btn btn-light ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            
                                        </div>
                                        <span class="text-danger"><?php echo $password_err; ?></span>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="remember-check">
                                                <label class="form-check-label" for="remember-check">
                                                    Remember me
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
                                    </div>
                                </form>

                                <!-- <div class="mt-4 pt-2 text-center">
                                    <div class="signin-other-title">
                                        <h5 class="font-size-14 mb-3 text-muted fw-medium">- Sign in with -</h5>
                                    </div>

                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="javascript:void()" class="social-list-item bg-primary text-white border-primary">
                                                <i class="mdi mdi-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript:void()" class="social-list-item bg-info text-white border-info">
                                                <i class="mdi mdi-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript:void()" class="social-list-item bg-danger text-white border-danger">
                                                <i class="mdi mdi-google"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="mt-5 text-center">
                                    <p class="text-muted mb-0">Don't have an account ? <a href="#" class="text-primary fw-semibold"> Signup now </a> </p>
                                </div> -->
                            </div>
                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">© <script>
                                        document.write(new Date().getFullYear())
                                    </script> Mediola . Crafted with <i class="mdi mdi-heart text-danger"></i> by GlobalSpace Techonologies Ltd</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end auth full page content -->
            </div>
            <!-- end col -->
            <div class="col-xxl-9 col-lg-8 col-md-7">
                <div class="auth-bg pt-md-5 p-4 d-flex">
                    <div class="bg-overlay bg-primary"></div>
                    <ul class="bg-bubbles">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <!-- end bubble effect -->
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container fluid -->
</div>
<!-- <div class="loader">
    <button class="btn btn-primary" type="button" disabled>
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        Loading...
    </button>
</div> -->


<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>
<!-- password addon init -->
<script src="assets/js/pages/pass-addon.init.js"></script>


</body>

</html>