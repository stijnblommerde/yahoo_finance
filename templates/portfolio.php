<div>
    <span class="navi"><a href="quote.php">Quote</a></span>
    <span class="navi"><a href="buy.php">Buy</a></span>
    <span class="navi"><a href="sell.php">Sell</a></span>
    <span class="navi"><a href="history.php">History</a></span>
    <span class="navi"><a href="logout.php"><b>Log Out</b></a></span>
</div>
<br>
<div>
    <table class="table table-striped">
        <thead></thead>
        <tbody>
            <tr>
                <th>Symbol</th>
                <th>Name</th>
                <th>Shares</th>
                <th>Price</th>
                <th>TOTAL</th>
            </tr>
                
            <?php foreach($positions as $position): ?>
            <tr>
                <td><?= $position["symbol"] ?></td>
                <td><?= $position["name"] ?></td>
                <td><?= $position["shares"] ?></td>
                <td><?= round($position["price"], 2) ?></td>
                <td><?= round($position["total"], 2) ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
