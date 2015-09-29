<?php
    // access sell only when logged in
    // sell contains simple form with drop down menu containing symbols of positions 
    // and sell button
 
    // configuration
    require("../includes/config.php"); 
    
    // if user wants to sell a position
    if (empty($_POST)) {
    
        //access portfolio
        $positions = $_SESSION["positions"];
        render("sell_form.php", ["positions" => $positions]);  
    
    // else if user has sold a position (stored in $_POST)
    } else {
    
        // access variables
        $id = $_SESSION["id"];
        $id_int = intval($id);
        $symbol = $_POST["symbol"];
        $symbol_str = strval($symbol);
        $positions = $_SESSION["positions"];

        // get revenue of sold stock
        // get number of shares
        foreach($positions as $position) {
            if ($position["symbol"] == $symbol_str) {
                $total = $position["total"];
                $shares = $position["shares"];
            } 
        }
        
        // get price of stock
        $stock = lookup("$symbol");
        $price = $stock["price"];
        
        //add revenue of sold stock to cash
        query("UPDATE `users` SET cash = cash + $total WHERE id = $id");
        
        // delete position from porfolio
        query("DELETE FROM `portfolios` WHERE id = ? AND symbol = ?", $id_int, $symbol_str);    
        
        // store transaction in transactions table
        $rows = query("SELECT NOW()");
        $datetime = $rows[0]["NOW()"];
        query("INSERT INTO `transactions` (id, transaction, datetime, symbol, shares, price)" 
        . " VALUES (?, ?, ?, ?, ?, ?)", $id, "SELL", $datetime, $symbol, $shares, $price);          
        
        //redirect to index.php
        redirect("index.php");  
    }
    

?>
