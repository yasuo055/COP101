<?php
include('Conn.php'); // Include database connection

// Check if the user ID is provided in the URL
if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];

    // Fetch the user's current data
    $sql = "SELECT USERID, FNAME, MNAME, LNAME, USERNAME, EMAIL, CONTACT, DATECREATED, ROLE FROM users WHERE USERID = :userid";
    $stmt = $connpdo->prepare($sql);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("User not found.");
    }
} else {
    // die("Invalid request.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $role = $_POST['role'];

    // Update the user's data in the database
    $updateSql = "UPDATE users SET FNAME = :fname, MNAME = :mname, LNAME = :lname, USERNAME = :username, EMAIL = :email, CONTACT = :contact, ROLE = :role WHERE USERID = :userid";
    $updateStmt = $connpdo->prepare($updateSql);
    $updateStmt->bindParam(':fname', $fname);
    $updateStmt->bindParam(':mname', $mname);
    $updateStmt->bindParam(':lname', $lname);
    $updateStmt->bindParam(':username', $username);
    $updateStmt->bindParam(':email', $email);
    $updateStmt->bindParam(':contact', $contact);
    $updateStmt->bindParam(':role', $role);
    $updateStmt->bindParam(':userid', $userid, PDO::PARAM_INT);

    if ($updateStmt->execute()) {
        header("Location: user-management-dashboard.php"); // Redirect back to the user management page
        exit();
    } else {
        echo "Error updating user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit User</title>
  <link rel="stylesheet" href="/style.css">
  <link rel="stylesheet" href="/style-table.css">
</head>
<body>
  <div class="header">
    <!-- Your header content here -->
  </div>
  <div class="sidebar">
    <!-- Your sidebar content here -->
  </div>

  <div class="report">
    <p style="font-size: 25px; margin-bottom: 10px;">
      Edit User
    </p>
    <div class="container-user-management-border-dashboard">
      <form method="POST" action="">
        <div class="form-group">
          <label for="fname">First Name:</label>
          <input type="text" id="fname" name="fname" value="<?php echo htmlspecialchars($user['FNAME']); ?>" required>
        </div>
        <div class="form-group">
          <label for="mname">Middle Name:</label>
          <input type="text" id="mname" name="mname" value="<?php echo htmlspecialchars($user['MNAME']); ?>">
        </div>
        <div class="form-group">
          <label for="lname">Last Name:</label>
          <input type="text" id="lname" name="lname" value="<?php echo htmlspecialchars($user['LNAME']); ?>" required>
        </div>
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['USERNAME']); ?>" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['EMAIL']); ?>" required>
        </div>
        <div class="form-group">
          <label for="contact">Contact Number:</label>
          <input type="text" id="contact" name="contact" value="<?php echo htmlspecialchars($user['CONTACT']); ?>">
        </div>
        <div class="form-group">
          <label for="role">Role:</label>
          <select id="role" name="role" required>
            <option value="Admin" <?php echo ($user['ROLE'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
            <option value="User" <?php echo ($user['ROLE'] == 'User') ? 'selected' : ''; ?>>User</option>
          </select>
        </div>
        <button type="submit" class="action-btn edit-btn">Update User</button>
      </form>
    </div>
  </div>
</body>
</html>