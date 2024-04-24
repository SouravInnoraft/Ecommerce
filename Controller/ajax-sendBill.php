<?php
require_once __DIR__ . './../Controller/ActionController.php';

// Creating object of ActionController class.
$action = new ActionController();
session_start();
$rows = $action->displayCart($_SESSION['email_id']);
$total = 0;
$count = 0;

require_once __DIR__ .'./../Controller/pdf.php';
// Clear the cart.
$action->clearCart($_SESSION['email_id']);
// Send bill.
$action->sendBill($_SESSION['email_id']);

