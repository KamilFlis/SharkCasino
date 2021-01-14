<nav class="topnav" id="myTopnav">
    <a href="startPage" class="logo"><img src="public/img/logo.png" alt="logo"></a>
    <ul class="menu-buttons">
        <li><a href="slotsPage" class="button">Slots</a></li>
        <li><a href="roulettePage" class="button">Roulette</a></li>
        <li><a href="cardsPage" class="button">Cards</a></li>
        <li><a href="jackpotPage" class="button">Jackpot</a></li>
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
            <li><a href="registerPage" class="button">Register</a></li>
        <?php endif; ?>
    </ul>
    <div>
        <a href="javascript:void(0);" class="icon" onclick="toggleMenu()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
</nav>