<!DOCTYPE html>

<html lang="eng">
<head>
    <title>Shark Casino</title>
    <link rel="stylesheet" type=text/css href="public/css/styles.css">
    <link rel="stylesheet" type=text/css href="public/css/accountInfo.css">
    <script type="text/javascript" src="public/js/hamburger.js" defer></script>
    <script type="text/javascript" src="public/js/search.js" defer></script>
</head>

<body>
<div class="base-container">
    <?php include("public/views/templates/navbar.php") ?>
    <div class="info-container">
        <?php include("public/views/templates/sideMenu.php") ?>
        <div class="info" id="general-info">
            <h1>Security</h1>
            <form class="change-password" action="changePassword" method="POST">
                <input name="oldPassword" type="password" placeholder="Old password">
                <input name="newPassword" type="password" placeholder="New password">
                <input name="confirmPassword" type="password" placeholder="Confirm password">
                <button type="submit">Change password</button>
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
</div>
<?php include("public/views/templates/footer.php") ?>
</body>


</html>