<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirm-password'];
  
  // Validate form data
  $errors = [];
  
  if (empty($name)) {
    $errors[] = 'Name is required.';
  }
  
  if (empty($email)) {
    $errors[] = 'Email is required.';
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email format.';
  }
  
  if (empty($password)) {
    $errors[] = 'Password is required.';
  }
  
  if (empty($confirmPassword)) {
    $errors[] = 'Confirm password is required.';
  } else if ($password !== $confirmPassword) {
    $errors[] = 'Passwords do not match.';
  }
  
  // If no errors, process form data
  if (empty($errors)) {
    // Connect to database (replace with your own database details)
    $host = 'localhost';
    $username = 'id20398697_admin';
    $password = '<[%m/2yJ*x[-@G6z';
    $dbname = 'id20398697_signup';
    
    $conn = mysqli_connect($host, $username, $password, $dbname);
    
    if (!$conn) {
      die('Connection failed: ' . mysqli_connect_error());
    }
    
    // Insert data into database (replace with your own table and field names)
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    
    if (mysqli_query($conn, $sql)) {
      echo 'Form submitted successfully.';
    } else {
      echo 'Error: ' . mysqli_error($conn);
    }
    
    mysqli_close($conn);
  } else {
    // If errors, display error messages
    foreach ($errors as $error) {
      echo '<div class="error">' . $error . '</div>';
    }
  }
}
?>
