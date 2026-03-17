<?php
    require_once(__DIR__ . "/../Includes/init.php");

    //! prevent browser caching
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");

    // if already logged in, redirect to dashboard
    if(isset($_SESSION['user'])) {
        redirect("dashboard.php");
    }

    $error = "";

    //* Clever hack do while(false) -> can do guard clause since we do before we loop, but loop is a fake 
    do {
        if(empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["pass"])) break;

        $username = htmlspecialchars($_POST["username"], ENT_QUOTES);
        if(!preg_match('/^[a-zA-Z0-9_]+$/', $username)){
            $error = "Invalid username.";
            break;
        }

        $email = htmlspecialchars($_POST["email"], ENT_QUOTES);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error = "Invalid email.";
            break;
        }

        $password = htmlspecialchars(trim($_POST["pass"]), ENT_QUOTES);
        $checked = $_POST["chckBx"] ?? null;

        if(!isset($checked)) break;

        if($auth->register($username, $email, $password)){
            redirect("../index.php");
            exit();
        }

        $error = "Email already in use.";
    } while(false);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="../Assets/CSS/global.css">
    <link rel="stylesheet" href="../Assets/CSS/auth.css">

    <link rel="shortcut icon" href="../Assets/Img/FaviconGhibli.png" type="image/x-icon">

    <script src="../Assets/JS/auth.js" defer></script>
</head>

<body>
    <div id="registerBG">
        <div class="container" id="registerC">
            <div class="rightDsn"></div>
            <form action="" method="post" novalidate>
                <h1>CREATE ACCOUNT</h1>

                <?php if($error): ?>
                    <p class="errorMsg"><?= $error ?></p>
                <?php endif?>

                <div class="inputFields">
                    <div class="lblNField">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="usernameR">
                        <span id="username-errorR" ></span>
                    </div>
                    <div class="lblNField">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="emailR">
                        <span id="email-errorR"></span>
                    </div>
                    <div class="lblNField">
                        <label for="pass">Password:</label>
                        <input type="password" name="pass" id="passR">
                        <span id="pass-errorR"></span>
                    </div>
                </div>
                <div id="agreementGroup">
                    <input type="checkbox" name="chckBx" id="chckBx">
                    <label for="chckBx">I accept the terms of the agreement.</label>
                    <span id="chckBx-unchecked"></span>
                </div>
                
                <input type="submit" name="sbmtR" id="sbmtR" value="Sign Up">

                <div id="signInAcc">
                    <p>Already have an account? </p>
                    <a href="login.php">Log in</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>