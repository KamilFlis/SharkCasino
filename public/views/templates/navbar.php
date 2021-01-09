<nav class="topnav" id="myTopnav">
    <img class ="logo" src="public/img/logo.png" alt="logo">
    <ul class="menu-buttons">
        <li><a href="slotsPage" class="button">Slots</a></li>
        <li><a href="#" class="button">Roulette</a></li>
        <li><a href="cardsPage" class="button">Cards</a></li>
        <li><a href="#" class="button">Jackpot</a></li>
        <?php if(isset($_SESSION["name"])):?>
            <li>
                <a href="logout" class="button">Log out</a>
            </li>
            <li><a href="accountInfo" class="button">
                    <?php
                    if(isset($_SESSION["name"])) {
                        echo "Welcome ".$_SESSION["name"];
                    }
                    ?>
                </a>
            </li>
        <?php else:?>
            <li><a href="loginPage" class="button">Login</a></li>
            <li><a href="#" class="button">Register</a></li>
        <?php endif; ?>
    </ul>
    <div class="hamburger-menu">
        <a href="javascript:void(0);" class="icon" onclick="toggleMenu()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
</nav>