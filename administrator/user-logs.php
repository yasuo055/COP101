<?php
session_start();
include('Conn.php');

// Fetch logs from database
// $stmt = $connpdo->query("
//     SELECT 
//     ul.log_id, 
//     ul.USERID, 
//     CONCAT(u.FNAME, ' ', u.MNAME, ' ', u.LNAME) AS NAME, 
//     u.ROLE, 
//     u.EMAIL, 
//     DATE_FORMAT(ul.login_time, '%Y-%m-%d %h:%i:%s %p') AS login_time, 
//     DATE_FORMAT(ul.logout_time, '%Y-%m-%d %h:%i:%s %p') AS logout_time
// FROM user_logs ul
// JOIN USERS u ON ul.USERID = u.USERID
// ORDER BY ul.login_time DESC;

// ");

// $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

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
      <img src="/icon/Vector.png" class="side-wat">
      <p class="drp">
        Water Parameters
      </p>
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
    <a href="report-administrator.html">
    <div class="end-portion-sidebar-admin-1">
      <button class="reports-admin-btn">
        <img src="/icon/Group (4).png" class="report-icon-sidebar">
        Reports
      </button>
    </div>
  </a>
  <a href="notification-admin.html">
    <div class="end-portion-sidebar-admin-2">
      <button class="notif-admin-btn">
        <img src="/icon/Vector (20).png" class="report-icon-sidebar">
        Notifications
      </button>
    </div>
  </a>
  <a href="user-logs.php">
    <div class="end-portion-sidebar-admin-3">
      <button class="att-log-admin-btn" style="background-color: #BFEDFE;">
        <img src="/icon/Vector (21).png" class="report-icon-sidebar">
        User logs
      </button>
    </div>
  </a>
  <a href="user-management-dashboard.php">
    <div class="end-portion-sidebar-admin-4">
      <button class="user-manag-admin-btn">
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
      User logs
    </p>
    <div class="sub-header-report-dashboard">
      <div class="left-portion-sub-header-dashboard">
      <input type="text" id="searchInput" placeholder="Search..." class="search-notification-dashboard">

<!-- Role Filter -->
<select id="User-Logs-roleFilter">
    <option value="">All Roles</option>
    <option value="admin">Admin</option>
    <option value="user">User</option>
</select>

 <!-- Filter Dropdowns -->
 <select id="todayFilter" onchange="applyFilter()">
    <option value="">Today</option>
    <option value="1hour">Last 1 Hour</option>
    <option value="4hours">Last 4 Hours</option>
    <option value="8hours">Last 8 Hours</option>
</select>

<select id="dayFilter" onchange="applyFilter()">
    <option value="">All Day</option>
    <option value="1day">1 Day Ago</option>
    <option value="2days">2 Days Ago</option>
    <option value="3days">3 Days Ago</option>
    <option value="4days">4 Days Ago</option>
    <option value="5days">5 Days Ago</option>
    <option value="6days">6 Days Ago</option>
    <option value="7days">7 Days Ago</option>
</select>

<!-- Month Filter -->
<select id="monthFilter">
    <option value="">Month</option>
    <option value="1">January</option>
    <option value="2">February</option>
    <option value="3">March</option>
    <option value="4">April</option>
    <option value="5">May</option>
    <option value="6">June</option>
    <option value="7">July</option>
    <option value="8">August</option>
    <option value="9">September</option>
    <option value="10">October</option>
    <option value="11">November</option>
    <option value="12">December</option>
</select>

<!-- Year Filter -->
<select id="yearFilter">
    <option value="">Year</option>
    <option value="1year">1 Year Ago</option>
    <option value="2years">2 Years Ago</option>
    <option value="3years">3 Years Ago</option>
</select>

<!-- Reset Button -->
<button id="resetBtn">Reset Filters</button>

<!-- Print Button -->
<button class="print-btn" onclick="window.print()">Print</button>
      </div>
    </div>

    <div class="contents-attendance-logs-administrator">
      <div class="head-content-attendance-logs-administrator">
        
    <!-- Logs Table -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Role</th>
            <th>Email</th>
            <th>Login Time</th>
            <th>Logout Time</th>
        </tr>
    </thead>
    <tbody id="logData">
        <!-- Filtered results will be loaded here -->
    </tbody>
</table>

      
      

      
      
    </div>
  </div>

  <script>
function applyFilter() {
    let todayFilter = document.getElementById("todayFilter").value;
    let dayFilter = document.getElementById("dayFilter").value;

    // Send AJAX request to PHP
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "fetch_logs.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("logData").innerHTML = xhr.responseText;
        }
    };
    xhr.send("todayFilter=" + todayFilter + "&dayFilter=" + dayFilter);
}

// Call applyFilter initially to populate logs
window.onload = applyFilter;

// Reset Button functionality
document.getElementById('resetBtn').addEventListener('click', function() {
    // Reset the dropdown values to their default state
    document.getElementById('todayFilter').value = ''; // Reset the "Today" dropdown
    document.getElementById('dayFilter').value = '';   // Reset the "Day" dropdown

    // Optionally, reload the page to reset the table data from the server
    window.location.reload(); // This will reload the page and reset everything (filters and table)

    // Alternatively, if you have dynamic filtering using AJAX, you can reset the table with an empty query:
    // resetTable(); // Uncomment and implement this if needed for dynamic table updates without page reload
});

// If you're dynamically filtering the table with JS, you could define resetTable like this:

function resetTable() {
    const tableBody = document.querySelector('tbody');
    // Remove all rows from the table (except the headers)
    tableBody.innerHTML = '';
    
    // Optionally, you could send an AJAX request to fetch all logs without filters
    // For example, using the current PHP backend (example pseudocode):
    /*
    fetch('your_php_backend_url.php')
        .then(response => response.json())
        .then(data => {
            // Update the table with the data from the server
            data.forEach(log => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${log.USERID}</td>
                    <td>${log.NAME}</td>
                    <td>${log.ROLE}</td>
                    <td>${log.EMAIL}</td>
                    <td>${log.login_time}</td>
                    <td>${log.logout_time || 'Still logged in'}</td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching data:', error));
    */
}

</script>
</body>
</html>