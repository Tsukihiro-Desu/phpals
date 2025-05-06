<?php 
session_start();
include "../connection.php";
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ALS - Admin Login</title>
    <meta name="description" content="Admin Login - Automated Learning System">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo text-center mb-4">
                    <h2 style="color: white; font-weight: 600;">
                        <i class="fa fa-lock"></i> Admin Portal
                    </h2>
                    <p class="text-muted">Automated Learning System</p>
                </div>
                <div class="login-form">
                    <form name="form1" action="" method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" name="username" class="form-control" placeholder="Enter username" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" name="submit1" class="btn btn-success btn-block btn-lg">
                                <i class="fa fa-sign-in"></i> Login
                            </button>
                        </div>
                        
                        <div class="text-center">
                            <a href="../login.php" class="btn btn-outline-dark btn-sm">
                                <i class="fa fa-arrow-left"></i> Back to Main Login
                            </a>
                        </div>

                        <div class="alert alert-danger alert-dismissible fade show mt-3" id="errormsg" style="display: none">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="fa fa-exclamation-circle"></i> Login Failed!</strong> Invalid username or password.
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>

<?php 
if(isset($_POST["submit1"]))
{
    $username = mysqli_real_escape_string($link, $_POST["username"]);
    $password = mysqli_real_escape_string($link, $_POST["password"]);

    $res = mysqli_query($link, "SELECT * FROM admin_login WHERE username='$username' AND password='$password'");
    $count = mysqli_num_rows($res);

    if($count == 0)
    {
        ?>
        <script type="text/javascript">
            document.getElementById("errormsg").style.display = "block";
        </script>
        <?php
    }
    else {
        $_SESSION["admin"] = $username;
        ?>
        <script type="text/javascript">
            window.location = "exam_category.php";
        </script>
        <?php 
    }
}
?>