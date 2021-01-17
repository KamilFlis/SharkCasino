<!DOCTYPE html>

<html lang="eng">
<head>
    <title>Shark Casino</title>
    <link rel="stylesheet" type=text/css href="public/css/styles.css">
    <link rel="stylesheet" type=text/css href="public/css/accountInfo.css">
    <script type="text/javascript" src="public/js/hamburger.js" defer></script>
    <script type="text/javascript" src="public/js/search.js" defer></script>
</head>

<body onload="getAddressData();">
<div class="base-container">
    <?php include("public/views/templates/navbar.php") ?>
    <div class="info-container">
        <?php include("public/views/templates/sideMenu.php") ?>
        <div class="info" id="general-info">
            <h1>Address Info</h1>
            <h2 class="label">Flat Number</h2>
            <h1 id="flatNumber"></h1>
            <h2 class="label">Postcode</h2>
            <h1 id="postcode"></h1>
            <h2 class="label">Street</h2>
            <h1 id="street"></h1>
            <h2 class="label">City</h2>
            <h1 id="city"></h1>
            <h2 class="label">Country</h2>
            <h1 id="country"></h1>
        </div>
    </div>
</div>
<?php include("public/views/templates/footer.php") ?>
</body>


</html>