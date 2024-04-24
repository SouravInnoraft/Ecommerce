<?php

/**
 * Class for validating user credentials.
 */
class FieldValidator{

  /**
   * Function to validate email.
   *
   * @param string $email
   *   User's email
   * @return boolean
   *   Return true if email is  a valid email
   */
  public function validateEmail(string $email): bool {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return FALSE;
    }
    return TRUE;
  }

  /**
   * Function to validate password.
   *
   * @param string $password
   *   User's password.
   * @return boolean
   *   Return true if password is valid.
   */
  public function validatePassword(string $password): bool {
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';

    if (preg_match($pattern, $password)) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Function to validate name.
   *
   * @param string $name
   *   User's name
   *
   * @return boolean
   *   Returns true if name is valid.
   */
  public function validateName(string $name): bool {
    if (!preg_match("/^[a-zA-z]*$/", $name)) {
      return FALSE;
    }
    return TRUE;
  }
}
