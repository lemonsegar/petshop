<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #d892c5;
            font-family: Arial, sans-serif;
        }
        .login-container {
            background-color: #fff;
            width: 300px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .login-container h2 {
            background-color: #00bfff;
            color: white;
            padding: 10px 0;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            margin-top: -20px;
            margin-bottom: 20px;
        }
        .profile-icon {
            background-color: #f0d2e2;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .profile-icon img {
            width: 50%;
            height: 50%;
        }
        .input-group {
            margin: 10px 0;
            position: relative;
        }
        .input-group input {
            width: 100%;
            padding: 10px;
            padding-left: 35px;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
        }
        .input-group .icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }
        .options {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #888;
            margin: 10px 0;
        }
        .login-btn {
            background-color: #d892c5;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
</head>
<body>

<form class="form-horizontal m-t-20" action="/login/ceklogin" method="post">
    <div class="login-container">
    <h2>SIGN IN</h2>
    <div class="profile-icon">
        <!-- Icon placeholder -->
        <img src="<?=base_url()?>/assets/images/mesjid.jpeg" alt="User Icon">
    </div>
    
    <?php
                if (session()->getFlashdata('msg')) : ?>
                    <div class="alert aler-danger">
                        <?= session()->getFlashdata('msg') ?> </div>

                <?php 
                endif;
                ?>
    <div class="input-group">
        <span class="icon">&#128100;</span>
        <input type="text" placeholder="Username" name="username">
    </div>
    <div class="input-group">
        <span class="icon">&#128274;</span>
        <input type="password" placeholder="Password" name="password">
    </div>
    <div class="options">
        <label><input type="checkbox"> Remember me</label>
        <a href="#" style="color: #d892c5;">Forgot your password?</a>
    </div>
    <button type="submit" class="login-btn">LOGIN</button>
    </form>
</div>

</body>
</html>