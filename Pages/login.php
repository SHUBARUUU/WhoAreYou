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

// Declares an error var - a checker if email is in database
$error = "";

if (!empty($_POST["email"]) && !empty($_POST["pass"])) {
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES);
    $password = htmlspecialchars(trim($_POST["pass"]), ENT_QUOTES);

    if ($auth->login($email, $password)) {
        redirect('../index.php');
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../Assets/CSS/global.css">
    <link rel="stylesheet" href="../Assets/CSS/auth.css">

    <link rel="shortcut icon" href="../Assets/Img/FaviconGhibli.png" type="image/x-icon">

    <script src="../Assets/JS/auth.js" defer></script>
</head>

<body>
    <div id="loginBG">
        <div class="container" id="loginC">
            <div class="rightDsn"></div>
            <form action="" method="post">
                <h1>USER LOGIN</h1>
                <!-- Templating - controls which HTML renders based on PHP conditions  -->
                <!-- Alternative syntax - a special way of writing conditionals and loops inside HTML -->
                <?php if ($error): ?>
                    <p class="errorMsg"><?= $error ?></p>
                <?php endif; ?>

                <div class="inputFields">
                    <div class="lblNField">
                        <label for="emailL">Email:</label>
                        <input type="email" name="email" id="emailL">
                        <span id="email-errorL" ></span>
                    </div>
                    <div class="lblNField">
                        <label for="passL">Password:</label>
                        <input type="password" name="pass" id="passL">
                        <span id="pass-errorL" ></span>
                    </div>
                </div>
                <div id="createAcc">
                    <p>Don't have an account? </p>
                    <a href="register.php">Sign Up</a>
                </div>
                <input type="submit" name="sbmt" id="sbmtL" value="Login">
            </form>
        </div>
    </div>
</body>

</html>