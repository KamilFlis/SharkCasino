<!DOCTYPE html>

<html lang="eng">
    <head>
        <title>Shark Casino</title>
        <link rel="stylesheet" href="public/css/styles.css">
    </head>

    <body>
        <div class="container">
            <div class="logo-login">
                <a href="startPage.php"><img src="public/img/logoo.png"></a>
                <p class="quote">Play to win!</p>
            </div>
           
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
        <footer>
            Copyright 2020 | Created by Kamil Flis
        </footer>
    </body>


</html>