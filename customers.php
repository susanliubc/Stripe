<?php
    require_once('config/db.php');
    require_once('lib/pdo_db.php');
    require_once('modeld/Customers.php');

    //Instantiate Customer
    $customer = new Customer();

    //Get customer
    $customers = $customer->getCustomers();
?>

<body>
    <div class="container">
        <div class="btn-group" role="group">
            <a href="customers.php" class="btn btn-primary">Customers</a>
            <a href="transanctions.php" class="btn btn-secondary">Transactions</a>
        </div>
        <hr>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($customers as $c): ?>
                    <tr>
                        <td><?php echo $c->id; ?></td>
                        <td><?php echo $c->first_name; ?> <?php echo $c->last_name; ?></td>
                        <td><?php echo $c->email; ?></td>
                        <td><?php echo $c->created_at; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <p><a href="index.php">Pay Page</a></p>
    </div>
</body>
