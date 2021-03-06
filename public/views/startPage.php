<?php session_start(); ?>
<!DOCTYPE html>

<html lang="eng">
<head>
    <title>Shark Casino</title>
    <link rel="stylesheet" type=text/css href="public/css/styles.css">
    <script type="text/javascript" src="public/js/expand.js" defer></script>
    <script type="text/javascript" src="public/js/hamburger.js" defer></script>
</head>
    <body>
        <div class="base-container">
            <?php include("public/views/templates/navbar.php") ?>
            <div class="banner">
                <img src="public/img/banner.png" alt="banner">
            </div>

            <div class="catchphrase">
                <h1>All Games!</h1>
            </div>

            <div class="games">
                 <img src="public/img/coming_soon.jpg" alt="coming soon">
                <a href="slotsCleopatra"><img src="public/img/cleopatraslots.png" alt="cleopatra slots"></a>
                <img src="public/img/coming_soon.jpg" alt="coming soon">
                <img src="public/img/coming_soon.jpg" alt="coming soon">
                <img src="public/img/coming_soon.jpg" alt="coming soon">
                <img src="public/img/coming_soon.jpg" alt="coming soon">
                <img src="public/img/coming_soon.jpg" alt="coming soon">
                <img src="public/img/coming_soon.jpg" alt="coming soon">
                <img src="public/img/coming_soon.jpg" alt="coming soon">
            </div>

            <div class="qa">
                <div class="question-block" id="question_1" onclick="expand(this)">How to play</div>
                <section class="answer-block">
                    <p class="answer">Login in and select your favourite game!</p>
                </section>
                <div class="question-block" id="question_2" onclick="expand(this)">How to pay in</div>
                <section class="answer-block">
                    <p>After logging in click on "Welcome 'your name'". Then move to wallet section and click Top up button!</p>
                </section>
                <div class="question-block" id="question_3" onclick="expand(this)">Play responsibly</div>
                <section class="answer-block">
                    <p>You are playing for money. Be responsible!</p>
                </section>
            </div>
        </div>

        <?php include("public/views/templates/footer.php") ?>
    </body>
</html>