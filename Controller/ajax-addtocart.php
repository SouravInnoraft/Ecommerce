<?php

require_once __DIR__ . './../Controller/ActionController.php';

// Creating object of ActionController class.
$action = new ActionController();

session_start();
$pid=$_POST['product_id'];

// Checking is product already exists in cart.
$quantity=$action->productExist($_SESSION['email_id'], $pid);
if ($quantity!=0) {

  // Update cart.
  $action->updateCart($pid,$quantity+1);
}
else {
  // Insert into cart.
  $action->addToCart($_SESSION['email_id'], $pid, 1);
}
