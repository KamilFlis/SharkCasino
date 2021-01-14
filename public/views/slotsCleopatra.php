<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cleopatra Slots</title>
    <link rel="stylesheet" type=text/css href="public/css/slots.css">
    <script type="module" src="public/js/slotsCleopatra/index.js" defer></script>
</head>
<body>
    <div class="messages">
        <?php if(isset($messages)): ?>
            <h2 class="message">Your money: <?php echo $messages[0]; ?></h2>
           <?php endif; ?>
    </div>

    <div class="slots">
        <div class="reel"></div>
        <div class="reel"></div>
        <div class="reel"></div>
        <div class="reel"></div>
        <div class="reel"></div>
    </div>

    <div id="controls">
        <button type="button" class="spin">SPIN</button>
    </div>

</body>
</html>