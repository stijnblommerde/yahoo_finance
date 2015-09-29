 <div>
    <table class="table table-striped">
        <thead></thead>
        <tbody>
            <tr>
                <th>Transaction</th>
                <th>Date/Time</th>
                <th>Symbol</th>
                <th>Shares</th>
                <th>Price</th>
            </tr>
                
            <?php foreach($transactions as $transaction): ?>
            <tr>
                <td><?= $transaction["transaction"] ?></td>
                <td><?= $transaction["datetime"] ?></td>
                <td><?= $transaction["symbol"] ?></td>
                <td><?= $transaction["shares"] ?></td>
                <td>$<?= round($transaction["price"], 2) ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
