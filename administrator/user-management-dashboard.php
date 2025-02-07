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
  <link rel="stylesheet" href="/style-tab.css">
  <link rel="icon" href="/icon/PONDTECH__2_-removebg-preview 2.png">
  <title>Aqua Sense</title>
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
        Attendance Logs
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
    <button class="tab-item" id="all-user">All User</button>
    <button class="tab-item" id="request">Request</button>
    <button class="tab-item" id="archive">Archive</button>
</div>


      <div class="middle-sub-header-user-management-dashboard">
        <div class="left-portion-user-management-dashboard">
         
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

      <div class="tab-content">
    <div class="content" id="content-all-user">
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
    $sql = "SELECT * FROM users WHERE archived = 0"; // Show only non-archived users
    $stmt = $connpdo->prepare($sql);
    $stmt->execute();
    

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
          //   echo "<td> 
          //   <button class='action-btn edit-btn' type='button' onclick='Edit(" . htmlspecialchars($row['USERID'], ENT_QUOTES, 'UTF-8') . ")'>
          //       Edit
          //   </button> 
          // </td>";
                echo "<td>
               <a href='edit-user.php?userid=" . $row['USERID'] . "'>
            <button class='action-btn edit-btn'>Edit</button>
        </a>
              <button class='action-btn archive-btn' data-id='" . $row['USERID'] . "'>Archive</button>

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
    </div>
    <div class="content" id="content-request">
        <p>Request content here...</p>
    </div>
    <div class="content" id="content-archive">
        <p>Archive content here...</p>
    </div>
</div>
   

    


  <div id="editUserModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Edit User</h2>
        <form id="editUserForm">
            <input type="hidden" id="userid" name="userid">
            <label>First Name:</label>
            <input type="text" id="fname" name="fname" required><br>

            <label>Middle Name:</label>
            <input type="text" id="mname" name="mname"><br>

            <label>Last Name:</label>
            <input type="text" id="lname" name="lname" required><br>

            <label>Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label>Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label>Contact Number:</label>
            <input type="text" id="contact" name="contact"><br>

            <label>Role:</label>
            <select id="role" name="role" required>
                <option value="Admin">Admin</option>
                <option value="User">User</option>
            </select><br>

            <button type="submit">Update User</button>
        </form>
    </div>
</div>

<!-- FOR TAB -->
<script>
document.querySelectorAll('.tab-item').forEach(tab => {
    tab.addEventListener('click', () => {
        // Remove active class from all tabs and content
        document.querySelectorAll('.tab-item').forEach(item => item.classList.remove('active'));
        document.querySelectorAll('.content').forEach(content => content.classList.remove('active'));

        // Add active class to clicked tab
        tab.classList.add('active');

        // Show the corresponding content
        const contentId = `content-${tab.id}`;
        document.getElementById(contentId).classList.add('active');
    });
});

// Ensure 'All User' tab is active by default on page load
window.onload = () => {
    // Simulate a click on the 'All User' tab
    document.getElementById('all-user').click();
};
</script>


<!-- FOR ARCHIVE FUNCTION -->
 <script>
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".archive-btn").forEach(button => {
        button.addEventListener("click", function () {
            let userID = this.getAttribute("data-id");

            if (confirm("Are you sure you want to archive this user?")) {
                fetch("archive-user.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "userid=" + userID
                })
                .then(response => response.text())
                .then(data => {
                    alert(data); // Show success message
                    location.reload(); // Refresh the table
                });
            }
        });
    });
});

 </script>

<script>


  document.addEventListener("DOMContentLoaded", function () {
    const editButtons = document.querySelectorAll(".edit-btn");
    const modal = document.getElementById("editUserModal");
    const closeModal = document.querySelector(".close-btn");

    editButtons.forEach(button => {
        button.addEventListener("click", function () {
            const userId = this.dataset.userid;
            
            // Fetch user data
            fetch("get-user.php?userid=" + userId)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("userid").value = data.USERID;
                    document.getElementById("fname").value = data.FNAME;
                    document.getElementById("mname").value = data.MNAME;
                    document.getElementById("lname").value = data.LNAME;
                    document.getElementById("username").value = data.USERNAME;
                    document.getElementById("email").value = data.EMAIL;
                    document.getElementById("contact").value = data.CONTACT;
                    document.getElementById("role").value = data.ROLE;

                    // Show the modal
                    modal.style.display = "block";
                });
        });
    });

    // Close the modal
    closeModal.addEventListener("click", function () {
        modal.style.display = "none";
    });

    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });

    // Handle form submission
    document.getElementById("editUserForm").addEventListener("submit", function (e) {
        e.preventDefault();
        
        const formData = new FormData(this);

        fetch("update-user.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(message => {
            alert(message); // Show update result
            modal.style.display = "none"; // Hide modal
            location.reload(); // Refresh table
        });
    });
});

</script>



</body>
</html>