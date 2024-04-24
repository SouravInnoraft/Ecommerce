<?php

require_once 'Database.php';


// Class to Perform read operations.
class Read extends Database {

  /**
   * Constructor function to initialise objects at the time of creation.
   *
   * @param string $username
   * @param string $password
   * @param string $dbname
   */
  function __construct(string $username, string $dbpassword, string $dbname) {
    parent::__construct($username, $dbpassword, $dbname);
  }

  /**
   * Function to check existance of user.
   *
   * @param string $Email_id
   *   User's Email.
   *
   * @return bool
   */
  public function UserExist(string $email_id):bool {
    $sql_select = $this->getConnection()->prepare("SELECT email_id from
    User where email_id = ?");
    $sql_select->execute([$email_id]);
    $rows = $sql_select->fetchAll(PDO::FETCH_ASSOC);
    if (!count($rows)) {
      return true;
    }
    else {
      return false;
    }
  }

  /**
   * Function to get user.
   *
   * @param string $Email_id
   *   User's Email.
   */
  public function getUser(string $email_id) {
    $sql_select = $this->getConnection()->prepare("SELECT * from
    User where email_id = ?");
    $sql_select->execute([$email_id]);
    $rows = $sql_select->fetch(PDO::FETCH_ASSOC);
    if (!count($rows)) {
      return null;
    }
    else {
      return $rows;
    }
  }
   /**
   * Function to get post related data.
   *
   * @param string $Email_id
   *   User's Email.
   *
   * @return  array
   */
  public function getPost():array {
    $sql_select = $this->getConnection()->prepare("SELECT * from product");
    $sql_select->execute();
    $rows = $sql_select->fetchAll(PDO::FETCH_ASSOC);
    if (!count($rows)) {
      return null;
    }
    else {
      return $rows;
    }
  }

  /**
   * Function to get post data which is searched.
   *
   * @param string $search
   *   User provided value to be searched.
   *
   * @return array
   */
  public function getPostwithSearch(string $search):array {
    $sql_select = $this->getConnection()->prepare("SELECT * from product where
    product_name like '%$search%'");
    $sql_select->execute();
    $rows = $sql_select->fetchAll(PDO::FETCH_ASSOC);
    if (!count($rows)) {
      return null;
    }
    else {
      return $rows;
    }
  }
  /**
   * Function to check password matching
   *
   * @param string $Email_id
   *   User's email.
   *
   * @param string $Password
   *   User entered password.
   *
   * @return bool
   */
  public function isPasswordCorrect(string $email_id, string $password):bool{
    $sql_select = $this->getConnection()->prepare("SELECT * from
    User where email_id = ?");
    $sql_select->execute([$email_id]);
    $rows = $sql_select->fetch(PDO::FETCH_ASSOC);
    if (password_verify($password, $rows['password'])) {
      return true;
    }
    else {
      return false;
    }
  }

  /**
   * Function to check product exists or not.
   *
   * @param string $email_id
   *   User's email.
   * @param int $product_id
   *   Product's id.
   */
  public function productExist(string $email_id, int $product_id){
    $sql_select = $this->getConnection()->prepare("SELECT * from
    cart where email_id = ? and product_id=?");
    $sql_select->execute([$email_id,$product_id]);
    $row = $sql_select->fetch(PDO::FETCH_ASSOC);
    if ($row==NULL) {
      return 0;
    }
    else {
      return $row['quantity'];
    }
  }

  /**
   * Function to display cart items.
   *
   * @param string $email_id
   *   User's email id.
   */
  public function displayCart(string $email_id){
    $sql_select = $this->getConnection()->prepare("SELECT * from
    cart as c INNER JOIN product as p ON c.product_id=p.product_id
    where email_id = ?");
    $sql_select->execute([$email_id]);
    $rows = $sql_select->fetchAll(PDO::FETCH_ASSOC);
    if (!count($rows)) {
      return null;
    }
    else {
      return $rows;
    }
  }

  /**
   * Function to clear cart.
   *
   * @param string $email_id
   *   User's email id.
   */
  public function clearCart(string $email_id){
    $sql_delete = $this->getConnection()->prepare("DELETE from
    cart where email_id = ?");
    $sql_delete->execute([$email_id]);
  }
}
