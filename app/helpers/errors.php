<?php


class Error {

  public function __construct()
  {
    
  }


  public function getErrorMsg($errorCode=null) {
    if ($errorCode !== null) {
      switch ($errorCode) {
        case 'not_logged_in':
          return "You are currently not logged in! Please login to access dashboard.";
        case 'password_invalid':
          return "The entered password is invalid! Please try again or contact admin to reset account.";
        case 'username_invalid':
          return "The entere username does not exist! Please register or contact admin.";
        default:
          return "Some error occured during your action";
      }
    }
  }
}