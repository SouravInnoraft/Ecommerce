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
   * Undocumented function
   *
   * @param string $password
   * @return boolean
   */
  public function validatePassword(string $password): bool {
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';

    if (preg_match($pattern, $password)) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Undocumented function
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
