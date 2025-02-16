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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 

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
      <button class="log-out" onclick="logout()">
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


      <!-- <div class="middle-sub-header-user-management-dashboard">
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
          <input type="text" placeholder="Search by name, email, or ID" class="search-user-management-database">
        </div>
      </div> -->

      <div class="tab-content">
    <div class="content" id="content-all-user">
    
    <div class="middle-sub-header-user-management-dashboard">
          <div class="left-portion-user-management-dashboard">
          
          </div>
          <div class="right-portion-user-management-dashboard">
            <p style="font-size: 13px; margin-right: 10px;">
              Filter By:
            </p>
            <select id="statusFilterActive">
              <option value="">All Status</option>
              <option value="active">Active</option>
              <option value="archived">Archived</option>
              <option value="deleted">Deleted</option>
          </select>
          <select id="roleFilterActive">
              <option value="">All Roles</option>
              <option value="admin">Admin</option>
              <option value="user">User</option>
          </select>
          <button id="resetFilterActive">Reset</button>
          
            <input type="text" id="searchInput" placeholder="Search by name, email, or ID" class="search-user-management-database">
          </div>
        </div>

    <div class="main-content-user-management-dashboard">
      <!-- <div class="container-user-management-border-dashboard"> -->
      

            <!-- <div class="main-content-user-management-dashboard"> -->
                <table border="0" width="100%" id="userTable">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Contact Number</th>
                            <th>Date Created</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <div id="loading" style="display:none;">Loading...</div>
                    <tbody id="userTableBody">
                   <!-- load data -->
                   
                    </tbody>
                </table>
            <!-- </div> -->
        <!-- </div> -->
  </div>
    </div>

    <div class="content" id="content-request">
    <div class="middle-sub-header-user-management-dashboard">
          <div class="left-portion-user-management-dashboard">
          
          </div>
          <div class="right-portion-user-management-dashboard">
            <p style="font-size: 13px; margin-right: 10px;">
              Filter By:
            </p>
            <select id="statusFilterRequest">
              <option value="">All Status</option>
              <option value="active">Active</option>
              <option value="archived">Archived</option>
              <option value="deleted">Deleted</option>
          </select>

          <select id="roleFilteRequest">
              <option value="">All Roles</option>
              <option value="admin">Admin</option>
              <option value="user">User</option>
              <option value="guest">Guest</option>
          </select>

          <button id="resetFilterRequest">Reset</button>

            <input type="text" id="Request-Search-Input" placeholder="Search by name, email, or ID" class="search-user-management-database">    
                </div>
        </div>
      
        <p>Request content here...</p>
    </div>
    

    <div class="content" id="content-archive">
    <div class="middle-sub-header-user-management-dashboard">
          <div class="left-portion-user-management-dashboard">
          
          </div>
          <div class="right-portion-user-management-dashboard">
            <p style="font-size: 13px; margin-right: 10px;">
              Filter By:
            </p>
            <select id="statusFilterArchive">
              <option value="">All Status</option>
              <option value="active">Active</option>
              <option value="archived">Archived</option>
              <option value="deleted">Deleted</option>
          </select>
          <select id="roleFilterArchive">
              <option value="">All Roles</option>
              <option value="admin">Admin</option>
              <option value="user">User</option>
          </select>
          <button id="resetFilterArchive" disabled>Reset</button>
            <input type="text" id="search-Archive-Input" placeholder="Search by name, email, or ID" class="search-user-management-database">
                    </div>
        </div>
        
      <table border="0" width="100%" id="archiveTables">
        <thead>
          <tr>
              <th>Employee ID</th>
              <th>Name</th>
              <th>Username</th>
              <th>Email</th>
              <th>Contact Number</th>
              <th>Date Created</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="user-search-Archive-Input-TableBody">
    <?php include 'fetch-archived-users.php'; ?>  <!-- Load initial user data -->
          
      
        </tbody>
    </table>
    <div id="loading" style="display:none;">Loading...</div>
    </div>
</div>
   

  <!-- Edit User Modal -->
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

<!-- LOGOUT -->
    <script>
function logout() {
    window.location.href = "/logout.php"; // Redirect to logout script
}
</script>


 <!-- FOR ARCHIVE FILTER -->

 <script>
document.addEventListener("DOMContentLoaded", function () {
    const roleFilterArchive = document.getElementById("roleFilterArchive");
    const resetFilterArchive = document.getElementById("resetFilterArchive");
    const tableBody = document.getElementById("user-search-Archive-Input-TableBody");

    // Function to fetch filtered users
    function fetchFilteredUsers(role) {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "fetch-archived-users.php?role=" + encodeURIComponent(role), true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                tableBody.innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }

    // Event Listener for Filter Change
    roleFilterArchive.addEventListener("change", function () {
        const selectedRole = roleFilterArchive.value;
        fetchFilteredUsers(selectedRole);

        // Enable reset button if a filter is applied
        resetFilterArchive.disabled = selectedRole === "";
    });

    // Reset Filter
    resetFilterArchive.addEventListener("click", function () {
        roleFilterArchive.value = "";
        fetchFilteredUsers(""); // Fetch all users again
        resetFilterArchive.disabled = true;
    });
});
</script>
 

    <!-- FOR FILTER ACTIVE USER-->

    <script>

$(document).ready(function () {
    // Function to fetch and update archived users based on selected role
    function fetchActivedUsers(role) {
        $("#loading").show(); // Show loading indicator
        $.ajax({
            url: "fetch-users.php", // Make sure this file correctly handles role filtering
            type: "POST",
            data: { role: role },
            success: function (response) {
                $("#userTable tbody").html(response);
                $("#loading").hide(); // Hide loading indicator
            },
            error: function () {
                alert("Error fetching Actived users.");
                $("#loading").hide();
            }
        });
    }

    // Trigger filter when role dropdown changes
    $("#roleFilterActive").change(function () {
        var selectedRole = $(this).val();
        fetchActivedUsers(selectedRole);
        $("#resetFilterActive").prop("disabled", selectedRole === ""); // Disable reset if no filter applied
    });

    // Reset filter
    $("#resetFilterActive").click(function () {
        $("#roleFilterActive").val(""); // Reset dropdown to default "All Roles"
        fetchActivedUsers(""); // Fetch all Actived users
        $(this).prop("disabled", true); // Disable reset button
    });

    // Initial load (optional)
    fetchActivedUsers(""); // Load all archived users on page load
});


 </script>

<!-- SEARCH BOX -->

<script>

document.getElementById("searchInput").addEventListener("keyup", function() {
    let searchQuery = this.value;

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "search-all-users.php?search=" + encodeURIComponent(searchQuery), true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("userTableBody").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
});

document.getElementById("search-Archive-Input").addEventListener("keyup", function() {
    let searchQuery = this.value;

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "search-archived-users.php?search=" + encodeURIComponent(searchQuery), true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("user-search-Archive-Input-TableBody").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
});


</script>


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
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("archive-btn")) {
            let userID = event.target.getAttribute("data-id");

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
        }
    });
});

 </script>

<!-- FOR RESTORE FUNCTION -->
 <script>

document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("restore-btn")) {
            let userID = event.target.getAttribute("data-id");

            if (confirm("Are you sure you want to restore this user?")) {
                fetch("restore-user.php", {
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
        }
    });
});


 </script>

<!-- FOR Delete FUNCTION -->
 <script>

document.addEventListener("click", function (event) {
        if (event.target.classList.contains("delete-btn")) {
            let userID = event.target.getAttribute("data-id");

            if (confirm("Are you sure you want to delete this user? This action cannot be undone!")) {
                fetch("delete-user.php", {
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
        }
    });


 </script>

 

<!-- FOR EDIT -->
<script>
document.addEventListener("DOMContentLoaded", loadUsers);

// Function to load users via Fetch API
async function loadUsers() {
    try {
        const response = await fetch("fetch-user.php");
        const data = await response.json();

        const tableBody = document.getElementById("userTableBody");
        tableBody.innerHTML = ""; // Clear table before appending new rows

        const fragment = document.createDocumentFragment(); // Improve performance

        data.forEach(user => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${user.USERID}</td>
                <td>${user.FNAME} ${user.MNAME || ""} ${user.LNAME}</td>
                <td>${user.USERNAME}</td>
                <td>${user.EMAIL}</td>
                <td>${user.CONTACT || "N/A"}</td>
                <td>${user.DATECREATED}</td>
                <td>${user.ROLE}</td>
                <td>
                    <button class="edit-btn" data-userid="${user.USERID}">Edit</button>
                    <button class="action-btn archive-btn" data-id="${user.USERID}">Archive</button>
                </td>
            `;
            fragment.appendChild(row);
        });

        tableBody.appendChild(fragment);
    } catch (error) {
        console.error("Error loading users:", error);
        alert("Failed to load users. Please try again later.");
    }
}

// Event Delegation for Edit Button Click
document.getElementById("userTableBody").addEventListener("click", async function(event) {
    if (event.target.classList.contains("edit-btn")) {
        const userId = event.target.dataset.userid;
        try {
            const response = await fetch(`get-user.php?userid=${userId}`);
            const user = await response.json();
            openEditModal(user);
        } catch (error) {
            console.error("Error fetching user details:", error);
            alert("Failed to fetch user details.");
        }
    }
});

// Open Edit Modal Function
function openEditModal(user) {
    document.getElementById("userid").value = user.USERID || "";
    document.getElementById("fname").value = user.FNAME || "";
    document.getElementById("mname").value = user.MNAME || "";
    document.getElementById("lname").value = user.LNAME || "";
    document.getElementById("username").value = user.USERNAME || "";
    document.getElementById("email").value = user.EMAIL || "";
    document.getElementById("contact").value = user.CONTACT || "";
    document.getElementById("role").value = user.ROLE || "";

    document.getElementById("editUserModal").style.display = "block";
}

// Close Modal when clicking the Close Button
document.querySelector(".close-btn").addEventListener("click", () => {
    document.getElementById("editUserModal").style.display = "none";
});

// Handle form submission with Fetch API
document.getElementById("editUserForm").addEventListener("submit", async function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    const submitButton = this.querySelector("button[type='submit']");
    submitButton.disabled = true; // Prevent double submission

    try {
        const response = await fetch("update-user.php", {
            method: "POST",
            body: formData
        });

        const result = await response.text();
        alert(result);
        document.getElementById("editUserModal").style.display = "none";
        loadUsers(); // Refresh table after updating
    } catch (error) {
        console.error("Error updating user:", error);
        alert("Failed to update user. Please try again.");
    } finally {
        submitButton.disabled = false;
    }
});


</script>





<script src="script.js"></script>
</body>
</html>