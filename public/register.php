<?php
    // configuration
    require("../includes/config.php");
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }
    
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // invalid data: apologize
        if (empty($_POST["username"]) || empty($_POST["password"]) || 
        $_POST["password"] != $_POST["confirmation"]) 
        {    
            apologize("Error: Enter valid data");
        }
   
        //valid data: register new user
        else 
        {    
            $result = query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", 
            $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT));
            
            if($result === false) 
            {
                apologize("Error: Insert failed. Username already exists");        
            } 
            
            else 
            {
                // get id of new user
                $rows = query("SELECT LAST_INSERT_ID() AS id");
                $id = $rows[0]["id"];
                
                // remember that user's now logged in by storing user's ID in session
                $_SESSION["id"] = $id;

                // redirect to index.php
                redirect("/");
            }
        }   
    }
?>
