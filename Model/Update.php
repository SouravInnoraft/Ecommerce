<?php


require_once 'Database.php';

// Class for Inserting Data into Database.
class Update extends Database {

  /**
   * Constructor function to initialise objects of the class.
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
   * Function to updateProfile data.
   *
   * @param string $first_name
   *   User provided first name.
   * @param string $last_name
   *   User provided last name.
   * @param string $email
   *   User provided email
   */
  public function updateProfile(string $first_name, string $last_name,string $email){
     $update=$this->getConnection()->prepare("UPDATE User SET
     first_name='$first_name',
     last_name='$last_name'
     WHERE
     email_id='$email'
     ");
     $update->execute();
  }

  /**
   * Function to reset password.
   *
   * @param string $token
   *   Token send on Email.
   * @param string $Email_id
   *   User's Email.
   * @param string $Password
   *   User's new password.
   *
   * @return bool
   *  Returns true on success.
   */
  public function resetPassword(string $email_id, string $password): bool {
      $update = $this->getConnection()->prepare("UPDATE User
        SET Password = ?
        WHERE email_id = ?");
      $update->execute([password_hash($password, PASSWORD_DEFAULT), $email_id]);
      return true;
    }

  /**
   * Function to updateCart
   *
   * @param string $product_id
   *   Product id.
   * @param integer $quantity
   *   Number of items of each product.
   */
  public function updateCart(string $product_id, int $quantity) {
    $update = $this->getConnection()->prepare("UPDATE cart
        SET quantity = ?
        WHERE product_id = ?");
    $update->execute([$quantity,$product_id]);
  }
}
