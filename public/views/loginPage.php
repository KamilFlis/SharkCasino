<!DOCTYPE html>

<html lang="eng">
<head>
    <title>Shark Casino</title>
    <link rel="stylesheet" type=text/css href="public/css/styles.css">
</head>

<body>
    <?php include("public/views/templates/loginLogo.php") ?>
        <div class="login-container">
            <form class="login" action="login" method="POST">
                <input name="username" type="text" placeholder="username">
                <input name="password" type="password" placeholder="password">
                <button type="submit">Login</button>
                <div class="messages">
                    <?php if(isset($messages)) {
                        foreach($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
    <?php include("public/views/templates/footer.php") ?>
</body>
</html>