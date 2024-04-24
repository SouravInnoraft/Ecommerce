<?php

require_once __DIR__ . './../Controller/ActionController.php';

// Creating object of ActionController class.
$action = new ActionController();
session_start();
// Clearing the cart.
$action->clearCart($_SESSION['email_id']);
