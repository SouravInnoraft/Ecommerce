<?php

require_once __DIR__ . './../Controller/ActionController.php';

// Creating object of ActionController class.
$action = new ActionController();

// Loading post
$rows = $action->getPost();
foreach ($rows as $row) {
?>
  <div class="card">
    <img src="Image/<?= $row['product_image'] ?>" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title"><?= $row['product_name'] ?></h5>
      <p>DESC:</p>
      <p class="card-text"><?= $row['product_desc'] ?></p>
      <p class="card-text">Price : ₹ <?= $row['product_price'] ?></p>
      <button class="btn btn-primary" id='addtocart' data-productid="<?= $row['product_id']?>">Add to Cart</button>
    </div>
  </div>
<?php
}
