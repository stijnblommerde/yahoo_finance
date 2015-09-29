<?php 
    require('../includes/config.php');
    
    if(!isset($_POST["symbol"])) 
    {
        render('../templates/quote_form.php');
    } 
    
    else
    {   
        // look up stock's symbol, name, price 
        $stock = lookup($_POST["symbol"]);
        
        if ($stock === false) 
        {
            apologize("invalid symbol");
        } 
        
        else
        {
            // get formatted price
            $price = number_format($stock['price'], 2);
            
            // render price
            render('../templates/display_stock.php', ["symbol"=>$stock['symbol'], 
                                                      "name"=>$stock['name'], 
                                                      "price"=>$price]);        
        }
    }
?>
