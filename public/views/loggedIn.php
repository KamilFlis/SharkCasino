<!DOCTYPE html>

<html lang="eng">
<head>
    <title>Shark Casino</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body>
<div class="base-container">
    <nav>
        <img class ="logo" src="public/img/logoo.png" alt="logo">
        <ul class="menu-buttons">
            <li><a href="#" class="button">Slots</a></li>
            <li><a href="#" class="button">Roulette</a></li>
            <li><a href="#" class="button">Cards</a></li>
            <li><a href="#" class="button">Jackpot</a></li>
        </ul>
<!--        <ul class="login-buttons">-->
        <ul class="login-buttons">
            <div class="messages">
                <?php if(isset($messages)) {
                    foreach($messages as $message) {
                        echo "Welcome ".$message;
                    }
                }
                ?>
            </div>
            <div>
                <a href="#" class="button">Log out</a>

            </div>
<!--            <li><a href="#" class="login-button">Login</a></li>-->
<!--            <li><a href="#" class="register-button">Register</a></li>-->
        </ul>
    </nav>
    <section>
        <img class="banner" src="public/img/sample_banner.png">
    </section>
    <main class="qa">
        <div class="question-block">How to play</div>
        <div class="question-block">How to pay in</div>
        <div class="question-block">Questions (FAQ)</div>
    </main>
</div>
<footer>
    Copyright 2020 | Created by Kamil Flis
</footer>
</body>


</html>