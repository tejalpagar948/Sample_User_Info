<!-- register.php -->
<?php
include 'db.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Hash the password for security
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Check if the username already exists
  $stmt = $conn->prepare("SELECT * FROM user_info WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    echo "Username already taken. Please choose another one.";
  } else {
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO user_info (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
      echo "Registration successful!";
    } else {
      echo "Error: " . $stmt->error;
    }
  }

  // Close connections
  $stmt->close();
  $conn->close();
}
?>