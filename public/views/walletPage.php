<!DOCTYPE html>

<html lang="eng">
<?php include("public/views/templates/accountInfoHeader.php") ?>

<body onload="getWalletData();">
<div class="base-container">
    <?php include("public/views/templates/navbar.php") ?>
    <div class="info-container">
        <?php include("public/views/templates/sideMenu.php") ?>
        <div class="info" id="general-info">
            <h1>Wallet</h1>
            <h2 class="label">Amount</h2>
            <h1 id="amount"></h1>
            <form class="top-up" action="topUp" method="POST">
                <input name="amount" type="number" placeholder="Amount">
                <button>Top up</button>
            </form>
            <div class="messages">
                <?php if(isset($messages)) {
                    foreach($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include("public/views/templates/footer.php") ?>
</body>

</html>