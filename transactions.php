<?php
    require_once('config/db.php');
    require_once('lib/pdo_db.php');
    require_once('modeld/Transactions.php');

    //Instantiate Transaction
    $transaction = new Transaction();

    //Get customer
    $transaction = $transaction->getTransactions();
?>

<body>
    <div class="container">
        <div class="btn-group" role="group">
            <a href="customers.php" class="btn btn-secondary">Customers</a>
            <a href="transanctions.php" class="btn btn-primary">Transactions</a>
        </div>
        <hr>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($transactions as $t): ?>
                    <tr>
                        <td><?php echo $t->id; ?></td>
                        <td><?php echo $t->customer_id; ?></td>
                        <td><?php echo $t->product; ?></td>
                        <td><?php echo sprintf('%,2f', $t->amount /100); ?> <?php echo strupper($t->currency) ?></td>
                        <td><?php echo $t->created_at; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <p><a href="index.php">Pay Page</a></p>
    </div>
</body>
