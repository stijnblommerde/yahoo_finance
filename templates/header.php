<!DOCTYPE html>

<html>

    <head>

        <link href="/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="/css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="/css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title>Yahoo Finance: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Yahoo Finance</title>
        <?php endif ?>

        <script src="/js/jquery-1.11.1.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/scripts.js"></script>

    </head>

    <body>

        <div class="container">

            <div id="top">
                <a href="/"><img id="logo" alt="Yahoo Finance" src="/img/logo.jpg"/></a>

                <!-- show navbar if user is logged in -->
                <?php if(!empty($_SESSION["id"])): ?>
                    <div class="navi">
                        <span class="navi"><a href="quote.php">Quote</a></span>
                        <span class="navi"><a href="buy.php">Buy</a></span>
                        <span class="navi"><a href="sell.php">Sell</a></span>
                        <span class="navi"><a href="history.php">History</a></span>
                        <span class="navi"><a href="logout.php"><b>Log Out</b></a></span>
                    </div>
                <?php endif ?>

            </div>

            <div id="middle">
