<form action="../sell.php" method="post">
    <fieldset>       
        <div class="form-group">
            <select class="form-control" name="symbol">
                <option value=""></option>
                
                <?php 
                    foreach($positions as $position): 
                    $symbol = $position['symbol'];
                ?>
                
                    <option value="<?= $symbol ?>"><?= $symbol ?></option>
                <?php endforeach ?>
                
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Sell</button>
        </div>
    <fieldset>
</form>

