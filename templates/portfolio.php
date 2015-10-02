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

                <!-- price is irrelevant for CASH -->
                <?php if($position["symbol"] != "CASH"): ?>
                <td>$<?= round($position["price"], 2) ?></td>
                <?php else: ?>    
                <td></td>
                <?php endif ?>    
            
                <td>$<?= round($position["total"], 2) ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
