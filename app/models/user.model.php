<?php


class User extends Database {
  
  public function __construct() {
    if ($_SESSION['user_type'] !== "user") {
      header("Location: " . $_ENV['ROOT']  . "dashboard/login.php");
    }
    parent::__construct();
  }
  
  
  // Get user details
  public function getUserDetails($userId) {
    $this->connect();
    $sql = "SELECT * FROM tbl_users WHERE user_id='" . $userId . "'";
    
    $result = mysqli_query($this->db_conn, $sql);
    
    if (mysqli_num_rows($result) === 1) {
      $data =  mysqli_fetch_assoc($result);
      $this->close();
      return $data;
    } else {
      return false;
    }
  }
  
  // Get user prescriptions
  public function getUserPrescriptions($userId) {
    $this->connect();
    $sql = "SELECT * FROM tbl_prescriptions WHERE user_id='" . $userId . "'";
    
    $result = mysqli_query($this->db_conn, $sql);
    
    $presc = [];
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $presc[$row['presc_id']] = $row;
      }
      $this->close();
      return $presc;
    } else {
      return false;
    }
  }
  
  // Get user medical aid
  public function getUserMedicalAid($userId) {
    $user = $this->getUserDetails($userId);
    if ($user !== false) {
      $this->connect();
      $sql = "SELECT * FROM tbl_medical_aid WHERE med_id='" . $user['med_aid'] . "'";
      $result = mysqli_query($this->db_conn, $sql);
      
      if (mysqli_num_rows($result) === 1) {
        $data =  mysqli_fetch_assoc($result);
        $this->close();
        return $data;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
  
  // Update personal details
  public function updatePersonalDetails($data) {
    $this->connect();
    $stmt = mysqli_prepare($this->db_conn, "UPDATE tbl_users SET dob=?, email=?, phone_number=? WHERE user_id=?;");
    mysqli_stmt_bind_param($stmt, 'ssss', $data['dob'], $data['email'], $data['phone_number'], $data['user_id']);
    
    $result = mysqli_stmt_execute($stmt);
    $this->close();
    return $result;
  }
  
  // Update medical aid
  public function updateMedicalAid($data) {
    $this->connect();
    $stmt = mysqli_prepare($this->db_conn, "UPDATE tbl_users SET med_aid=? WHERE user_id=?;");
    mysqli_stmt_bind_param($stmt, 'ss', $data['med_id'], $data['user_id']);
    
    if (mysqli_stmt_execute($stmt)) {
      $stmt = mysqli_prepare($this->db_conn, "UPDATE tbl_medical_aid SET med_id=?, employer=?, issue_date=?, expiry_date=? WHERE med_id=?;");
      mysqli_stmt_bind_param($stmt, 'sssss', $data['med_id'], $data['employer'], $data['issue_date'], $data['expiry_date'], $data['med_aid']);
      
      $result = mysqli_stmt_execute($stmt);
      $this->close();
      return $result;
    } else {
      $this->close();
      return false;
    }
  }
  
  // Update password
  public function resetPassword($data) {
    $this->connect();
    $stmt = mysqli_prepare($this->db_conn, "UPDATE tbl_users SET password=? WHERE user_id=?;");
    mysqli_stmt_bind_param($stmt, 'ss', $data['password'], $data['user_id']);
    $result = mysqli_stmt_execute($stmt);
    
    $this->close();
    return $result;
  }
}