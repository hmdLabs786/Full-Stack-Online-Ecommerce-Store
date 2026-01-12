<?php
// Include database or authentication logic
include("query.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Zufe Admin Login</title>

    <!-- Fonts and Styles -->
    <link rel="icon" type="image/png" href="images/icons/zufelogo-removebg-preview.png"/>
    <link href="adminpanel3/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="adminpanel3/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-image: url('images/BG-L2.png'); /* Same as register page */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(15px);
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 40px 30px;
            max-width: 400px;
            width: 100%;
        }

        .form-control-user {
            border-radius: 8px;
            padding: 15px;
        }

        .btn-user {
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
        }

        /* Dark purple login button */
        .btn-login {
            background: linear-gradient(135deg, #4a148c, #6a1b9a) !important;
            border: none !important;
            color: white !important;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #6a1b9a, #8e24aa) !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(106, 27, 154, 0.4);
        }

        .checkbox-left {
            text-align: left;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 30px 20px;
                max-width: 90%;
            }
        }
    </style>
</head>

<body>

    <div class="login-card text-center">
        <h3 class="text-gray-900 mb-4">Welcome Back!</h3>
        <p class="text-gray-600 mb-4">Sign in to your account</p>

        <form class="user" method="post">
            <div class="form-group">
                <input type="email" name="email" class="form-control form-control-user" placeholder="Enter Email Address..." required>
            </div>

            <div class="form-group">
                <input type="password" name="password" class="form-control form-control-user" placeholder="Password" required>
            </div>

            <div class="form-group">
                <div class="custom-control custom-checkbox small checkbox-left">
                    <input type="checkbox" class="custom-control-input" id="customCheck">
                    <label class="custom-control-label" for="customCheck">Remember Me</label>
                </div>
            </div>

            <button type="submit" name="btnn_login" class="btn btn-login btn-user btn-block">
                Sign In
            </button>
        </form>

        <hr>

        <div class="text-center">
            <a class="small" href="register.php">Don't have an account? Sign up!</a>
        </div>
    </div>

    <!-- Scripts -->
    <script src="adminpanel3/vendor/jquery/jquery.min.js"></script>
    <script src="adminpanel3/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="adminpanel3/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="adminpanel3/js/sb-admin-2.min.js"></script>
</body>
</html>
