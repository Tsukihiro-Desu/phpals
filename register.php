<?php
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Automated Learning System</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        :root {
            --primary: #4361ee;
            --accent: #4361ee;
            --secondary: #f8f9fa;
            --text: #2b2d42;
            --light-text: #8d99ae;
            --white: #ffffff;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        * {margin:0; padding:0; box-sizing:border-box;}
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: var(--text);
        }
        .register-container {
            width: 100%;
            max-width: 480px;
            animation: fadeInUp 0.6s both;
        }
        .register-card {
            background: var(--white);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        .register-header {
            background: linear-gradient(135deg, var(--accent), #4361ee);
            color: var(--white);
            padding: 30px;
            text-align: center;
        }
        .register-header .logo {
            font-size: 24px;
            font-weight: 700;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .register-header .logo i {
            margin-right: 10px;
        }
        .register-subtitle {
            font-size: 14px;
            opacity: 0.9;
        }
        .register-body {
            padding: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 5px;
            display: block;
        }
        .input-group {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            transition: var(--transition);
        }
        .input-group:focus-within {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(69, 97, 238, 0.6);
        }
        .input-group-prepend {
            background: var(--secondary);
            padding: 0 15px;
            color: var(--light-text);
            height: 48px;
            display: flex;
            align-items: center;
        }
        .form-control {
            flex: 1;
            padding: 0 15px;
            height: 48px;
            border: none;
            outline: none;
            font-size: 14px;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 12px 24px;
            background: var(--accent);
            color: var(--white);
            font-size: 15px;
            font-weight: 600;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: var(--transition);
        }
        .btn:hover {
            background: #3a56d4;
            transform: translateY(-2px);
        }
        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            animation: fadeIn 0.3s both;
        }
        .alert-success {
            background: #e6ffed;
            color: #2e7d32;
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background: #fee;
            color: #d32f2f;
            border: 1px solid #f5c6cb;
        }
        .footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: var(--light-text);
        }
        .mb-2 { margin-bottom: 12px; }
        .mb-3 { margin-bottom: 20px; }

        @keyframes fadeInUp {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>

<div class="register-container animate__animated animate__fadeIn">
    <div class="register-card">
        <div class="register-header">
            <div class="logo">
                <i class="fas fa-user-plus"></i>
                <span>Create an Account</span>
            </div>
            <p class="register-subtitle">Join Automated Learning System</p>
        </div>
        <div class="register-body">
            <form action="" method="post">
                <?php
                $showSuccess = false;
                $showFailure = false;

                if(isset($_POST["submit1"])) {
                    $res = mysqli_query($link, "SELECT * FROM registration WHERE username='" . mysqli_real_escape_string($link, $_POST["username"]) . "'");
                    if(mysqli_num_rows($res) > 0) {
                        $showFailure = true;
                    } else {
                        mysqli_query($link, "INSERT INTO registration VALUES(NULL, 
                            '" . mysqli_real_escape_string($link, $_POST["firstname"]) . "',
                            '" . mysqli_real_escape_string($link, $_POST["lastname"]) . "',
                            '" . mysqli_real_escape_string($link, $_POST["username"]) . "',
                            '" . mysqli_real_escape_string($link, $_POST["password"]) . "',
                            '" . mysqli_real_escape_string($link, $_POST["email"]) . "',
                            '" . mysqli_real_escape_string($link, $_POST["contact"]) . "')");
                        $showSuccess = true;
                    }
                }
                ?>

                <!-- Input Fields -->
                <div class="form-group">
                    <label>First Name</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><i class="fas fa-user"></i></div>
                        <input type="text" name="firstname" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><i class="fas fa-user"></i></div>
                        <input type="text" name="lastname" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><i class="fas fa-user-tag"></i></div>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><i class="fas fa-lock"></i></div>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><i class="fas fa-envelope"></i></div>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Contact</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><i class="fas fa-phone"></i></div>
                        <input type="text" name="contact" class="form-control" required>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mb-3">
                    <button type="submit" name="submit1" class="btn">
                        <i class="fas fa-user-plus" style="margin-right: 10px;"></i> Register
                    </button>
                </div>

                <?php if ($showSuccess): ?>
                    <div class="alert alert-success">
                        <strong>Success!</strong> Registration completed successfully.
                    </div>
                <?php elseif ($showFailure): ?>
                    <div class="alert alert-danger">
                        <strong>Failed!</strong> Username already exists. Try another one.
                    </div>
                <?php endif; ?>

                <div class="mb-2">
                    <button type="button" class="btn" onclick="window.location.href='login.php';">
                        <i class="fas fa-sign-in-alt" style="margin-right: 10px;"></i> Back to Login
                    </button>
                </div>

                <p class="footer-text">&copy; <?php echo date('Y'); ?> Automated Learning System</p>
            </form>
        </div>
    </div>
</div>

</body>
</html>
