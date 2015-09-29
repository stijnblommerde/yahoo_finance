<?php
    
    // access buy only when logged in
    require("../includes/config.php"); 
    
    // user wants to buy stock
    if (empty($_POST)) {

        // buy contains simple form to buy stock
        render("buy_form.php");  
        
    // user has bought stock
    } else {
        
        // get id, symbol, shares, stock details, budget, stock_in_portfolio 
        $id = $_SESSION["id"];
        $symbol = $_POST["symbol"];    
        $shares = $_POST["shares"];
        $stock = lookup($symbol); 
        $price = $stock["price"];
        
        $positions = $_SESSION["positions"];
        foreach($positions as $position) {
        
            if ($position["symbol"] == "CASH") {
                $budget = $position["total"];
            }
        }
        
        // invalid input: symbol unknown
        if ($stock === false) {
            apologize("Unknown stock");
        }
        
        // invalid input: not whole number of shares
        // regular expression checks for non-negative integer
        if (!preg_match("/^\d+$/", $shares)) {
            apologize("Buy a whole number of shares!");        
        }
        
        // invalid input: budget smaller than cost
        $cost = $shares * $price;
        if ($budget < $cost) {
            apologize("Do not overspend!");
        }
        
        // valid input: update or insert data and subtract cost from cash
        $symbol = strtoupper($symbol);
        query("INSERT INTO `portfolios` (id, symbol, shares) VALUES(?, ?, ?) ON"
        . " DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $id, $symbol, $shares);
        
        query("UPDATE `users` SET cash = cash - $cost WHERE id = $id");
        
        // store transaction in transactions table
        $rows = query("SELECT NOW()");
        $datetime = $rows[0]["NOW()"];
        query("INSERT INTO `transactions` (id, transaction, datetime, symbol, shares, price)" 
        . " VALUES (?, ?, ?, ?, ?, ?)", $id, "BUY", $datetime, $symbol, $shares, $price);    
        
        //redirect to index.php
        redirect("index.php");
    }
    
    
?>
