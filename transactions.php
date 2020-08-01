<?php
 require_once('config/db.php');
 require_once('lib/pdo_db.php');
 require_once('models/Transaction.php');

 //Instantiate Transaction
 $transaction = new Transaction();

 //Get transaction
 $transactions = $transaction->getTransactions();


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <title>VIew Transactions</title>
</head>
<body>
  <div class="container mt-4">
<div class="btn-group" role="group">
<a href="customers.php" class="btn btn-secondary">Customers</a>
<a href="transactions.php" class="btn btn-primary">Transactions</a>
</div>
<hr>
 <h2>Transactions</h2>
 <table class="table table-striped">
 <thead>
 <tr>
 <th>Transactions ID</th>
 <th>Customer</th>
 <th>Product</th>
 <th>Amount</th>
 <th>Date</th>
 </tr>
 </thead>
 <?php foreach($transactions as $t) :?>
<tr>
<td><?php echo $t->id ; ?> </td>
<td><?php echo $t->customer_id ; ?> </td>
<td><?php echo $t->product ; ?> </td>
<td><?php echo sprintf('%.2f',$t->amount /100) ; ?> 
<?php echo strtoupper($t->currency) ;?></td>
<td><?php echo $t->created_at ; ?> </td>

</tr>
 <?php endforeach ;?>
 </table>
 <p><a href="index.php">Pay Page</a></p>
  </div>
</body>
</html>