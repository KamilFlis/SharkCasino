<!DOCTYPE html>

<html lang="eng">
<head>
    <title>Shark Casino</title>
    <link rel="stylesheet" type=text/css href="public/css/styles.css">
    <link rel="stylesheet" type=text/css href="public/css/accountInfo.css">
    <script type="text/javascript" src="public/js/hamburger.js" defer></script>
    <script type="text/javascript" src="public/js/search.js" defer></script>
</head>

<body onload="getWalletData();">
<div class="base-container">
    <?php include("public/views/templates/navbar.php") ?>
    <div class="info-container">
        <?php include("public/views/templates/sideMenu.php") ?>
        <div class="info" id="general-info">
            <h1>Wallet</h1>
            <h2 class="label">Amount</h2>
            <h1 id="amount"></h1>
            <button>Top up</button>
        </div>
    </div>
</div>
<?php include("public/views/templates/footer.php") ?>
</body>


</html>