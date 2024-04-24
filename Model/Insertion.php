<?php

require_once 'Database.php';

// Class for Inserting Data into Database.
class Insertion extends Database {

  /**
   * Constructor function to initialise objects of the class.
   *
   * @param string $username
   *   User's name.
   * @param string $password
   *   Database password.
   * @param string $dbname
   *   Database name.
   */
  function __construct(string $username, string $dbpassword, string $dbname) {
    parent::__construct($username, $dbpassword, $dbname);
  }

  /**
   * Function to enter data into database.
   *
   * @param string $Email_id
   *   User's Email.
   * @param string $User_firstname
   *   User's firstname.
   * @param string $User_lastname
   *   User's lastname.
   * @param string $Password
   *   User's password.
   */
  public function insertUser( string $first_name,
  string $last_name,
    string $email_id,string $password) {
    $sql_insert = $this->getConnection()->prepare("INSERT INTO User
    (email_id,first_name,last_name,password) values (?,?,?,?)");
    $sql_insert->execute([$email_id, $first_name, $last_name,
     password_hash($password, PASSWORD_DEFAULT)]);
  }

  /**
   * Function to enter data into database.
   *
   * @param string $time
   *   Current time.
   * @param string $text
   *   User's firstname.
   * @param string $User_lastname
   *   User's lastname.
   * @param string $Password
   *   User's password.
   */
  public function addToCart(string $email_id, string $product_id, string $quantity) {
    $sql_insert = $this->getConnection()->prepare("INSERT INTO cart
    (email_id,product_id,quantity) values (?,?,?)");
    $sql_insert->execute([$email_id, $product_id, $quantity]);
  }
}
