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
            <li><a href="slotsPage" class="button">Slots</a></li>
            <li><a href="#" class="button">Roulette</a></li>
            <li><a href="cardsPage" class="button">Cards</a></li>
            <li><a href="#" class="button">Jackpot</a></li>
        </ul>
        <?php if(isset($_SESSION["name"])):?>
            <ul class="login-buttons">
                <div class="messages">
                    <?php
                    if(isset($_SESSION["name"])) {
                        echo "Welcome ".$_SESSION["name"];
                    }
                    ?>
                </div>
                <div>
                    <a href="logout" class="button">Log out</a>
                </div>
            </ul>

        <?php else:?>
            <ul class="login-buttons">
                <li><a href="loginPage" class="login-button">Login</a></li>
                <li><a href="#" class="register-button">Register</a></li>
            </ul>
        <?php endif; ?>
    </nav>

    <section class="catchphrase">
        <h1>Play our best cards games!</h1>
    </section>

    <main class="games">
        <img src="public/img/coming_soon1.jpg">
        <img src="public/img/coming_soon1.jpg">
        <img src="public/img/coming_soon1.jpg">
    </main>

</div>
<footer>
    Copyright 2020 | Created by Kamil Flis
</footer>
</body>


</html>