<?php

require_once __DIR__ .'./../Helper/Mailer.php';
require_once  __DIR__ .'./../Controller/FieldValidator.php';
require_once __DIR__ . '/../Model/Insertion.php';
require_once __DIR__ . '/../Model/Read.php';
require_once __DIR__ . '/../Model/Update.php';
require_once __DIR__ . '/../Core/Dotenv.php';
require_once __DIR__ . '/../vendor/autoload.php';

// Creating object of Dotenv class.
$env = new Dotenv();

/**
 * Class for controlling all controller actions.
 */
class ActionController {

  private $validator;
  private $select;
  private $insert;
  private $update;

  /**
   * Constructor function to initialise variables and objects.
   */
  public function __construct() {

    // Creating object of validator class.
    $this->validator=new FieldValidator();

    // Creating object of Read class.
    $this->select = new Read($_ENV['username'], $_ENV['dbpassword'], $_ENV['dbname']);

    // Creating object of Insertion class.
    $this->insert = new Insertion($_ENV['username'], $_ENV['dbpassword'], $_ENV['dbname']);

    // Creating object of Update class.
    $this->update = new Update($_ENV['username'], $_ENV['dbpassword'], $_ENV['dbname']);
  }
  /**
   * Function for Validating user registration.
   *
   * @param string $first_name
   *   User's first name.
   * @param string $last_name
   *   User's last name.
   * @param string $email_id
   *   User's email id.
   * @param string $password
   *   User's password.
   *
   * @return mixed
   *   Error or success message.
   */
  public function validateRegister(string $first_name,string $last_name,
  string $email_id,string $password):mixed {
    $msg='';
    $cls='';
   // Checking for valid email and password.
   if(
    $this->validator->validateEmail($email_id) &&
    $this->validator->validateName($first_name) &&
    $this->validator->validateName($last_name) &&
    $this->validator->validatePassword($password)
   ){
     // Checking if email id already registered or not.
      if ($this->select->UserExist($email_id)) {
        session_start();
        $_SESSION['email_id'] = $email_id;
        $_SESSION['password'] = $password;
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        // Sending Otp.
        $this->sendOtp($email_id);
      }
      else {
        $msg = 'UserExist';
        $cls='red';
      }
    }
    else {
      $msg = "Invalid UserInput";
      $cls = 'red';
    }
    return [$msg,$cls];
  }

  /**
   *
   *
   * @param string $email_id
   *   User's email id.
   * @param string $password
   *   User's password.
   *
   * @return boolean
   */
  public function validateLogin(string $email_id, string $password):bool {
   // Checking if email id exists or not and verifying email and password matches or not.
   if (!$this->select->UserExist($email_id) && $this->select->isPasswordCorrect($email_id,$password)){
      return TRUE;
   }
   return FALSE;
  }

  /**
   * Function to reset password.
   *
   * @param string $email_id
   *   User's email id.
   *
   * @return mixed
   */
  public function resetPassword(string $email_id):mixed{
    $msg = '';
    $cls = '';
    // Checking if email id exists or not.
  if (!$this->select->UserExist($email_id)){
      session_start();
      $_SESSION['email_id'] = $email_id;
     // Sending Otp
      $this->sendResetOtp($email_id);
     }
    else{
      $msg='Email Id doesn\'t exists';
      $cls='red';
    }
    return [$msg,$cls];
  }

/**
 * Function to send otp for verification
 *
 * @param string $email_id
 *   User's email id.
 */
  public function sendOtp(string $email_id){
   session_start();
    $OTP = rand(1000, 9999);
    $_SESSION['OTP'] = $OTP;
    // Creating an object of PHP-Mailer to send Otp via Mail.
    $Mail = new Mailer($email_id);
    // Calling class method and passing in the Otp to be send.
    if ($Mail->register($OTP)) {
      require_once __DIR__ . './../View/Otp.php';
    }
  }

  /**
   * Function to send otp for verification
   *
   * @param string $email_id
   *   User's email id.
   */
  public function sendResetOtp(string $email_id){
    session_start();
    $OTP = rand(1000, 9999);
    $_SESSION['OTP'] = $OTP;
    // Creating an object of PHP-Mailer to send Otp via Mail.
    $Mail = new Mailer($email_id);
    // Calling class method and passing in the Otp to be send.
    if ($Mail->reset($OTP)) {
      require_once __DIR__ . './../View/OtpReset.php';
    }
  }

  /**
   * Function to send otp for verification
   *
   * @param string $email_id
   *   User's email id.
   */
  public function sendBill(string $email_id){
    // Creating an object of PHP-Mailer to send Otp via Mail.
    $Mail = new Mailer($email_id);
    // Calling class method and passing in the Otp to be send.
    return $Mail->sendBill();
  }
  /**
   * Function to insert User
   *
   * @param string $first_name
   *   User's first name.
   * @param string $last_name
   *   User's last name.
   * @param string $email_id
   *   User's email id.
   * @param string $password
   *   User's password.
   */
  public function insertIntoUser(string $first_name, string $last_name, string $email_id, string $password){
     $this->insert->insertUser($first_name,$last_name,$email_id,$password);
  }

  /**
   * Function to update user details.
   *
   * @param string $email_id
   *   User's email id.
   * @param string $password
   *   User's password.
   */
  public function updateUser(string $email_id,string $password){
    $this->update->resetPassword($email_id,$password);
  }
  /**
   * Function to get product data.
   */
  public function getPost(){
   return $this->select->getPost();
  }
  /**
   * Function to check product exists or not.
   *
   * @param string $email_id
   *   User's email id
   * @param integer $product_id
   *   Product id.
   */
  public function productExist(string $email_id,int $product_id){
    return $this->select->productExist($email_id,$product_id);
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
  public function addToCart($email_id,$product_id,$quantity){
   $this->insert->addToCart($email_id, $product_id, $quantity);
  }

  /**
   * Function to updateCart
   *
   * @param string $product_id
   *   Product id.
   * @param int $quantity
   *   Number of items of each product.
   */
  public function updateCart($product_id,$quantity){
    $this->update->updateCart($product_id,$quantity);
  }

  /**
   * Function to display cart items.
   *
   * @param string $email_id
   *   User's email id.
   */
  public function displayCart($email_id){
    return $this->select->displayCart($email_id);
  }

  /**
   * Function to clear cart.
   *
   * @param string $email_id
   *   User's email id.
   */
  public function clearCart(string $email_id){
    $this->select->clearCart($email_id);
  }
}
