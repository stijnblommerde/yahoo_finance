<?php

    // configuration
    require("../includes/config.php"); 
    
    // get current id
    $id = $_SESSION["id"];
    
    // get portfolio data
    $rows = query("SELECT * FROM `portfolios` WHERE id = $id"); 
    
    // create array of positions
    $positions = array();
    $cost = 0;
    
    foreach ($rows as $row) {
        $stock = lookup($row["symbol"]);
        if ($stock !== false){
                       
            //compute position total
            $price_float = floatval($stock["price"]);            
            $shares_int = intval($row["shares"]);
            $total = $price_float * $shares_int;
            
            //compute cost of portfolio
            $cost += $total;
            
            array_push($positions, array(
                "name" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"],
                "total" => $total));
        }
    }
    
    //get cash from database
    $rows = query("SELECT cash FROM `users` WHERE id = $id");
    $row = $rows[0];
    $cash = $row['cash'];
    
    //get balance: cash minus portfolio cost
    //$balance = $cash - $cost;
    
    //add balance to positions
    array_push($positions, array(
        "name" => "",
        "price" => "",
        "shares" => "",
        "symbol" => "CASH",
        "total" => $cash));
    
    //store $positions in $_SESSION
    //session_start();
    $_SESSION["positions"] = $positions;
    
    // render portfolio
    render("portfolio.php", ["positions" => $positions, "title" => "Portfolio"]);
    
        
    
?>

