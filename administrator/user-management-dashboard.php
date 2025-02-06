<?php 

include('Conn.php'); 


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/style.css">
  <link rel="stylesheet" href="/style-table.css">
  <link rel="icon" href="/icon/PONDTECH__2_-removebg-preview 2.png">
  <title>Aqua Lense</title>


</head>
<body>
  <div class="header">
    <div class="right-portion">
      <img src="/icon/PONDTECH__2_-removebg-preview 2.png" class="head-right">
    </div>
    <div class="left-portion">
      <p class="tme">
        October 26, 2024 - 12:00:06PM
      </p>
      <img src="/icon/Ellipse 2 (1).png" class="head-left">
      <div class="user-name">
        <p class="user-full-name">
          Angel Sofia Balatucan
        </p>
        <p class="user-type">
          User
        </p>  
      </div>
    </div>
  </div>
  <div class="sidebar">
    <div class="upper-portion-2">
      <a href="dashboard.html">
      <img src="/icon/Vector (17).png" class="side-wat">
        <p class="drp">
          Dashboard
        </p>
      </a>
    </div>
    <div class="upper-portion-1">
      <a href="user.html">
      <img src="/icon/Vector.png" class="side-wat">
      <p class="drp">
        Water Parameters
      </p>
      </a>
    </div>
    <div class="middle-portion-admin">
      <a href="ph-lvl-admin.html">
      <button class="ph-admin">
        <img src="/icon/Group.png" class="ph-icon">
        PH Level
      </button>
      </a>
      <a href="temp-lvl-admin.html">
        <button class="temp-admin">
          <img src="/icon/Vector (1).png" class="temp-icon">
          Temperature
        </button>
      </a>
      <a href="amn-lvl-admin.html">
        <button class="amn-admin">
          <img src="/icon/Vector (2).png" class="amn-icon">
          Amonia
        </button>
      </a>
      <a href="oxy-lvl-admin.html">
        <button class="oxy-admin">
          <img src="/icon/Vector (3).png" class="oxy-icon">
          Oxygen
        </button>
      </a>
    </div>

    <div class="end-portion-sidebar-admin-1">
      <a href="report-administrator.html" class="reports-admin-btn-sample">
        <img src="/icon/Group (4).png" class="report-icon-sidebar">
        Reports
      </a>
    </div>

  <a href="notification-admin.html">
    <div class="end-portion-sidebar-admin-2">
      <button class="notif-admin-btn">
        <img src="/icon/Vector (20).png" class="report-icon-sidebar">
        Notifications
      </button>
    </div>
  </a>
  <a href="attendance-logs-administrator.html">
    <div class="end-portion-sidebar-admin-3">
      <button class="att-log-admin-btn">
        <img src="/icon/Vector (21).png" class="report-icon-sidebar">
        User Logs
      </button>
    </div>
  </a>
  <a href="user-management-dashboard.html">
    <div class="end-portion-sidebar-admin-4" >
      <button class="user-manag-admin-btn" style="background-color: #BFEDFE;">
        <img src="/icon/carbon_id-management.png" class="report-icon-sidebar">
        User Management
      </button>
    </div>
  </a>
    <div class="bottom-portion">
      <button class="log-out">
        <img src="/icon/solar_logout-2-broken.png" class="side-log">
        <p class="log">
          Log Out
        </p>
      </button>
    </div>
  </div>

  <div class="report">
    <p style="font-size: 25px; margin-bottom: 10px;">
      User Management
    </p>
    <div class="container-user-management-border-dashboard">
      <div class="head-user-management-dashboard">
        <p style="margin-left: 10px;">
          All User
        </p>
        <p>
          Request
        </p>
        <p style="margin-right: 10px;">
          Archieve
        </p>
      </div>
      <div class="middle-sub-header-user-management-dashboard">
        
        <div class="left-portion-user-management-dashboard">

        <!-- <button class="btn-user-management-add-user" onclick="openModal()">
        <img src="/icon/Vector (25).png" style="width: 15px; margin-right: 5px;">Add User
    </button> -->
    <div id="myModal" class="modal">
        <div class="modal-content"></div>
    </div>
        </div>

        <div class="right-portion-user-management-dashboard">
          <p style="font-size: 13px; margin-right: 10px;">
            Filter By:
          </p>
          <button class="status-user-management-dashboard">
            Status <img src="/icon/gridicons_dropdown.png" style="width: 18px; ">
          </button>
          <button class="status-user-management-dashboard">
            Role <img src="/icon/gridicons_dropdown.png" style="width: 18px;">
          </button>
          <input type="text" placeholder="Search" class="search-user-management-database">
        </div>
      </div>
      <div class="main-content-user-management-dashboard">
      <div class="container-user-management-border-dashboard">
           
            <div class="main-content-user-management-dashboard">
                <table border="0" width="100%">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Contact Number</th>
                            <th>Date Created</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php

   include('Conn.php');

    // Prepare and execute the SQL query using PDO
    $sql = "SELECT USERID, FNAME, MNAME, LNAME, USERNAME, EMAIL, CONTACT, DATECREATED, ROLE FROM users";
    $stmt = $connpdo->query($sql);

    // Check if there are rows to display
    if ($stmt->rowCount() > 0) {
        // Fetch each row and display the data
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['USERID'] . "</td>";
            echo "<td>" . $row['FNAME'] . " " . $row['MNAME'] . " " . $row['LNAME'] . "</td>";
            echo "<td>" . $row['USERNAME'] . "</td>";
            echo "<td>" . $row['EMAIL'] . "</td>";
            echo "<td>" . ($row['CONTACT'] ? $row['CONTACT'] : 'N/A') . "</td>"; 
            echo "<td>" . $row['DATECREATED'] . "</td>";
            echo "<td>" . $row['ROLE'] . "</td>";
            echo "<td>
                <a href='edit-user.php?userid=" . $row['USERID'] . "'><button class='action-btn edit-btn' onclick='openModal(" . $row['USERID'] . ")'>Edit</button></a>
                <a href='archive-user.php?userid=" . $row['USERID'] . "' onclick='return confirm(\"Are you sure you want to archive this user?\")'>
                    <button class='action-btn archive-btn'>Archive</button>
                </a>
              </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No users found</td></tr>";
    }
?>

                    </tbody>
                </table>
            </div>
        </div>
  </div>

  <!-- Modal HTML -->
  <div id="myModal" class="modal">
    <div class="modal-content">
        <div class="modal-con"> 
            <button class="close-btn" onclick="closeModal()">&times;</button>
            <h2>Edit User's Information</h2>
            <form method="POST">
    <label>First Name:</label>
    <input type="text" name="fname" value="<?php echo htmlspecialchars($user['FNAME']); ?>" required><br>

    <label>Middle Name:</label>
    <input type="text" name="mname" value="<?php echo htmlspecialchars($user['MNAME']); ?>" required><br>

    <label>Last Name:</label>
    <input type="text" name="lname" value="<?php echo htmlspecialchars($user['LNAME']); ?>" required><br>

    <label>Username:</label>
    <input type="text" name="username" value="<?php echo htmlspecialchars($user['USERNAME']); ?>" required><br>

    <label>Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($user['EMAIL']); ?>" required><br>

    <label>Contact:</label>
    <input type="text" name="contact" value="<?php echo htmlspecialchars($user['CONTACT']); ?>" required><br>

    <label>Role:</label>
    <select name="role">
        <option value="Admin" <?php echo ($user['ROLE'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
        <option value="User" <?php echo ($user['ROLE'] == 'User') ? 'selected' : ''; ?>>User</option>
    </select><br>

    <button type="submit">Update</button>
</form>
        </div>
    </div>
</div>



<script>
       // Open Modal and populate fields
function openModal(userId) {
    // Fetch user data using AJAX or fetch API
    fetch('get_user_data.php?userid=' + userId)
        .then(response => response.json())
        .then(data => {
            document.getElementById('fname').value = data.FNAME;
            document.getElementById('mname').value = data.MNAME;
            document.getElementById('lname').value = data.LNAME;
            document.getElementById('email').value = data.EMAIL;
            document.getElementById('contact').value = data.CONTACT;
            document.getElementById('role').value = data.ROLE;

            // Show the modal
            document.getElementById('myModal').style.display = 'block';
        })
        .catch(error => console.log('Error fetching user data: ', error));
}

// Close the modal
function closeModal() {
    document.getElementById('myModal').style.display = 'none';
}

// Submit the updated user information
function submitUserInfo() {
    // Get values from the form
    let userId = new URLSearchParams(window.location.search).get('userid'); // Get userID from URL or modal data
    let fname = document.getElementById('fname').value;
    let mname = document.getElementById('mname').value;
    let lname = document.getElementById('lname').value;
    let email = document.getElementById('email').value;
    let contact = document.getElementById('contact').value;
    let role = document.getElementById('role').value;

    // Send the updated data to the server using fetch or AJAX
    fetch('update_user.php', {
        method: 'POST',
        body: JSON.stringify({
            USERID: userId,
            FNAME: fname,
            MNAME: mname,
            LNAME: lname,
            EMAIL: email,
            CONTACT: contact,
            ROLE: role
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('User information updated successfully!');
            location.reload();  // Reload the page to reflect the changes
        } else {
            alert('Error updating user information.');
        }
    })
    .catch(error => console.log('Error:', error));
}

    </script>

</body>
</html>

<?php

?>