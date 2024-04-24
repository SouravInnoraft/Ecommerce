<?php
require_once __DIR__ . './../Controller/ActionController.php';

class UrlManagement{
  private $action;
  public function __construct() {
    $this->action = new ActionController();
  }

  /**
   * Function for manage url.
   */
  public function login(){
    if(isset($_POST['submit'])){
      if($this->action->validateLogin($_POST['email_id'],$_POST['password'])) {
        session_start();
        $_SESSION['email_id']=$_POST['email_id'];
        header('location:/home');
      }else{
         $msg='Invalid Login Creds';
         $cls='red';
      }
    }
    require_once __DIR__ .'/../View/Login.php';
  }

  /**
   * Function for manage url.
   */
  public function register(){
    if (isset($_POST['submit'])) {
      session_start();
      if ($_SESSION['OTP'] == $_POST['OTP']) {
        $this->action->insertIntoUser(
          $_SESSION['first_name'],
          $_SESSION['last_name'],
          $_SESSION['email_id'],
          $_SESSION['password']
        );
        $msg='Register Succesfully';
        $cls='green';
      }
      else{
        $msg = 'Error occured';
        $cls = 'red';
      }
    }
    require_once __DIR__ .'/../View/Register.php';
  }

  /**
   * Function for manage url.
   */
  public function reset(){
    if (isset($_POST['submit'])) {
      session_start();
      if ($_SESSION['OTP'] == $_POST['OTP']) {
        $this->action->updateUser(
          $_SESSION['email_id'],
          $_POST['password']
        );
        $msg = 'Register Succesfully';
        $cls = 'green';
      }
      else{
        $msg = 'Error occured';
        $cls = 'red';
      }
    }
    require_once __DIR__ .'/../View/Reset.php';
  }

  /**
   * Function for manage url.
   */
  public function Otp(){
    if (isset($_POST['submit'])) {
      header('location:/');
    }
    require_once __DIR__ .'/../View/Otp.php';
  }

  public function home(){
    session_start();
    if(isset($_SESSION['email_id'])){
      require_once __DIR__.'/../View/Home.php';
    }
    else{
      $msg = "Can't Access this page if not logged in";
      $cls = 'red';
      header('location:/');
    }
  }

  /**
   * Function for manage url.
   */
  public function logout(){
    session_start();
    // Unsetting Session Variables.
    session_unset();

    // Destroying the Session.
    session_destroy();

    // Navigating to login.
    header('location:/');
  }

  /**
   * Function for manage url.
   */
  public function cart(){
    require_once __DIR__ .'/../View/Cart.php';
  }

  /**
   * Function for manage url.
   */
  public function default(){
    require_once __DIR__ . '/../View/Login.php';
  }

}
