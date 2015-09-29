<?php
    // configuration
    require("../includes/config.php"); 
        
    // get id
    $id = $_SESSION["id"];
    
    // get transactions from table
    $transactions = query("SELECT * FROM `transactions` WHERE id = $id");
    
    render("history_table.php", ["transactions" => $transactions, "title" => "History"]);
?>
