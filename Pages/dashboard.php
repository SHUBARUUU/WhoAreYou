<?php 
    require_once(__DIR__ . "/../Includes/init.php");
    $auth -> requireLogin();

    $user = $_SESSION["user"] ?? null;
    $name = $_SESSION["name"] ?? null;
    $email = $_SESSION["email"] ?? null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>You are In</title>
    <link rel="stylesheet" href="../Assets/CSS/dashboard.css">
    <link rel="stylesheet" href="../Assets/CSS/global.css">

    <link rel="shortcut icon" href="../Assets/Img/FaviconGhibli.png" type="image/x-icon">

    <script src="../Assets/JS/dashboard.js" defer></script>
</head>
<body>
    <form action="logout.php" method="POST">
        <h1>You're in lmao</h1>
        <div class="inlineIntro">
            <h1>You are: </h1>
            <?php if($name): ?>
                <h1><?= $name ?></h1>
            <?php endif?>
        </div>
        <div class="inlineIntro">
            <h1>ID number: </h1>
            <?php if($user): ?>
                <h2><?= $user ?></h2>
            <?php endif?>
        </div>
        <div class="inlineIntro">
            <h1>Known as: </h1>
            <?php if($email): ?>
                <h2><?= $email ?></h2>
            <?php endif?>
        </div>
        <input type="button" id="quackBtn" value="Quack">
        <input type="submit" name="sbmtD" id="sbmtD" value="Log Out">
    </form>
</body>
</html>