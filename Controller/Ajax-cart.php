<?php

require_once __DIR__ . './../Controller/ActionController.php';

// Creating object of ActionController class.
$action = new ActionController();
session_start();

// Display cart items.
$rows = $action->displayCart($_SESSION['email_id']);
$total = 0;
$count = 0;
?>
<p class='center'>User:<?= $rows[0]['email_id'] ?></p>
<table class="table table-success table-striped-columns">
  <thead>
    <tr>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product_id</th>
      <th scope="col">Product Name</th>
      <th scope="col">Product image</th>
      <th scope="col">quantity</th>
      <th scope="col">Product Price</th>
    </tr>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($rows as $row) {
      $count++;
      $total += $row['product_price'] * $row['quantity'];
    ?>
      <tr>
        <th scope="row"><?= $count ?></th>
        <td><?= $row['product_id'] ?></td>
        <td><?= $row['product_name'] ?></td>
        <td class="cart-img"><img src="Image/<?= $row['product_image'] ?>" alt=""></td>
        <td><?= $row['quantity'] ?></td>
        <td>₹ <?= $row['product_price'] ?></td>
      </tr>
    <?php
    }
    ?>
    <tr>
      <td colspan="5"></td>
      <td>total:₹ <?= $total ?></td>
    </tr>
  </tbody>
</table>
<button class="btn btn-primary" id='clear-cart'>clear cart</button>
<button class="btn btn-primary" id='checkout'>Checkout</button>
