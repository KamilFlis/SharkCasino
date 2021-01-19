<!DOCTYPE html>

<html lang="eng">
<head>
    <title>Shark Casino</title>
    <link rel="stylesheet" type=text/css href="public/css/styles.css">
    <script type="text/javascript" src="public/js/validate.js" defer></script>
    <script type="text/javascript" src="public/js/search.js" defer></script>
</head>

<body onload="getCountries();">
    <?php include("public/views/templates/loginLogo.php") ?>
        <div class="login-container">
            <form class="register" action="register" method="POST">
                <input name="username" type="text" placeholder="Username">
                <input name="name" type="text" placeholder="Name">
                <input name="surname" type="text" placeholder="Surname">
                <input name="email" type="text" placeholder="Email">
                <input name="password" type="password" placeholder="Password">
                <input name="confirmPassword" type="password" placeholder="Confirm password">
                <input name="phoneNumber" type="number" placeholder="Phone number">
                <input name="flatNumber" type="number" placeholder="Flat number">
                <input name="postcode" type="number" placeholder="Postcode">
                <input name="street" type="text" placeholder="Street">
                <input name="city" type="text" placeholder="City">


<!--                <input name="country" type="text" placeholder="Country">-->
                <label>Country
                    <select id=country name="country">
                        <option value="Austria">Austria</option>
                    </select>
                </label>

                <input name="bankAccountNumber" type="number" placeholder="Bank account number">
                <div class="checkbox">
                    <input id="conditions" name="conditions" type="checkbox">
                    <label for="conditions">Accept terms and conditions</label>
                </div>
                <button type="submit">Register</button>
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