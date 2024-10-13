<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT * FROM user_info WHERE username = ?");
    if ($stmt) {
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Username already taken."]);
      } else {
        // Prepare and bind for insertion
        $stmt = $conn->prepare("INSERT INTO user_info (username, password) VALUES (?, ?)");
        if ($stmt) {
          $stmt->bind_param("ss", $username, $hashed_password);

          // Execute the statement
          if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Registration successful!"]);
          } else {
            echo json_encode(["status" => "error", "message" => "Registration failed."]);
          }
        } else {
          echo json_encode(["status" => "error", "message" => "Statement preparation failed."]);
        }
      }

      // Close connections
      $stmt->close();
    } else {
      echo json_encode(["status" => "error", "message" => "Statement preparation failed."]);
    }

    $conn->close();
  } else {
    echo json_encode(["status" => "error", "message" => "Username and password are required."]);
  }
} else {
  echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
