<!DOCTYPE html>

<html lang="eng">
<?php include("public/views/templates/accountInfoHeader.php") ?>

<body onload="getGeneralData();">
<div class="base-container">
    <?php include("public/views/templates/navbar.php") ?>
    <div class="info-container">
        <?php include("public/views/templates/sideMenu.php") ?>
        <div class="info" id="general-info">
            <h1>General Info</h1>
            <h2 class="label">Name</h2>
            <h1 id="name"></h1>
            <h2 class="label">Surname</h2>
            <h1 id="surname"></h1>
            <h2 class="label">Email</h2>
            <h1 id="email"></h1>
            <h2 class="label">Phone Number</h2>
            <h1 id="phoneNumber"></h1>
        </div>
    </div>
</div>
<?php include("public/views/templates/footer.php") ?>
</body>

</html>