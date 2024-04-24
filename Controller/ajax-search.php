<?php

require_once __DIR__ . './../vendor/autoload.php';
require_once __DIR__ . './../Model/Read.php';
require_once __DIR__ . './../Core/Dotenv.php';

$env = new Dotenv();
// Creating an object of Read class.
$select = new Read($_ENV['username'], $_ENV['dbpassword'], $_ENV['dbname']);

// Function to get post on search key.
$rows = $select->getPostwithSearch($_POST['search']);
foreach ($rows as $row) {
?>
  <div class="card" style="width: 18rem;">
    <img src="Image/<?= $row['product_image'] ?>" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title"><?= $row['product_name'] ?></h5>
      <p>DESC:</p>
      <p class="card-text"><?= $row['product_desc'] ?></p>
      <p class="card-text">Price : ₹ <?= $row['product_price'] ?></p>
      <a href="#" class="btn btn-primary">Add to Cart</a>
    </div>
  </div>
<?php
}
