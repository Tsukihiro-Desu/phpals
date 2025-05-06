<?php
session_start();
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login | Automated Learning System</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #f8f9fa;
            --accent: #f72585;
            --text: #2b2d42;
            --light-text: #8d99ae;
            --white: #ffffff;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: var(--text);
        }
        
        .login-container {
            width: 100%;
            max-width: 420px;
            animation: fadeInUp 0.6s both;
        }
        
        .login-card {
            background: var(--white);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        
        .login-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--white);
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
        }
        
        .logo {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .logo i {
            margin-right: 10px;
        }
        
        .login-subtitle {
            font-size: 14px;
            opacity: 0.9;
            font-weight: 400;
        }
        
        .login-body {
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 14px;
        }
        
        .input-group {
            position: relative;
            display: flex;
            align-items: center;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #e0e0e0;
            transition: var(--transition);
        }
        
        .input-group:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }
        
        .input-group-prepend {
            padding: 0 15px;
            background: var(--secondary);
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--light-text);
        }
        
        .form-control {
            flex: 1;
            height: 48px;
            padding: 0 15px;
            border: none;
            outline: none;
            background: transparent;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-size: 15px;
            text-decoration: none;
        }
        
        .btn-primary {
            background: var(--primary);
            color: var(--white);
            width: 100%;
        }
        
        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        .btn-outline {
            background: transparent;
            color: var(--primary);
            border: 1px solid var(--primary);
        }
        
        .btn-outline:hover {
            background: rgba(67, 97, 238, 0.1);
        }
        
        .btn-accent {
            background: var(--accent);
            color: var(--white);
        }
        
        .btn-accent:hover {
            background: #e5177b;
            transform: translateY(-2px);
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        
        .action-buttons .btn {
            flex: 1;
        }
        
        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            display: none;
            animation: fadeIn 0.3s both;
        }
        
        .alert-danger {
            background: #fee;
            color: #d32f2f;
            border: 1px solid #f5c6cb;
        }
        
        .close {
            float: right;
            font-size: 20px;
            font-weight: bold;
            line-height: 1;
            color: inherit;
            opacity: 0.7;
            background: none;
            border: none;
            cursor: pointer;
        }
        
        .footer-text {
            text-align: center;
            margin-top: 20px;
            color: var(--light-text);
            font-size: 13px;
        }
        
        @media (max-width: 480px) {
            .login-header {
                padding: 20px;
            }
            
            .login-body {
                padding: 20px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="login-container animate__animated animate__fadeIn">
        <div class="login-card">
            <div class="login-header">
                <div class="logo">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Automated Learning</span>
                </div>
                <p class="login-subtitle">Sign in to continue to your account</p>
            </div>
            
            <div class="login-body">
                <form action="" name="form1" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <i class="fas fa-user"></i>
                            </div>
                            <input type="text" class="form-control" id="username" name="username" 
                                   placeholder="Enter your username" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <i class="fas fa-lock"></i>
                            </div>
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Enter your password" required>
                        </div>
                    </div>
                    
                    <button type="submit" name="login" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt" style="padding: 10px;"></i> Login
                    </button>
                    
                    <div class="action-buttons">
                        <a href="register.php" class="btn btn-outline">
                            <i class="fas fa-user-plus" style="padding: 10px;"></i> Register
                        </a>
                        <a href="admin/" class="btn btn-accent">
                            <i class="fas fa-lock" style="padding: 10px;"></i> Admin
                        </a>
                    </div>
                    
                    <div class="alert alert-danger" id="failure">
                        <span><i class="fas fa-exclamation-circle"></i> <strong>Login failed!</strong> Invalid username or password.</span>
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </form>
                
                <p class="footer-text">&copy; <?php echo date('Y'); ?> Automated Learning System</p>
            </div>
        </div>
    </div>

    <?php
    if(isset($_POST['login']))
    {
        $username = mysqli_real_escape_string($link, $_POST['username']);
        $password = mysqli_real_escape_string($link, $_POST['password']);

        $res = mysqli_query($link, "SELECT * FROM registration WHERE username='$username' AND password='$password'");
        $count = mysqli_num_rows($res);

        if($count == 0)
        {
            ?>
            <script type="text/javascript">
                document.getElementById("failure").style.display = "block";
            </script>
            <?php
        } 
        else {
            $_SESSION["username"] = $username;
            ?>
            <script type="text/javascript">
                window.location = "home.php";
            </script>
            <?php
        }
    }
    ?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        $(document).ready(function() {
            // Add shake animation to error message
            if($('#failure').is(':visible')) {
                $('#failure').addClass('animate__animated animate__shakeX');
            }
            
            // Make alert dismissible
            $('.alert .close').on('click', function() {
                $(this).closest('.alert').fadeOut();
            });
            
            // Add hover effects
            $('.btn').hover(
                function() {
                    $(this).css('transform', 'translateY(-2px)');
                },
                function() {
                    $(this).css('transform', 'translateY(0)');
                }
            );
        });
    </script>
</body>
</html>