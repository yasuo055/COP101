<?php
session_start();
include('Conn.php');

// Fetch logs from database
$stmt = $connpdo->query("SELECT * FROM user_logs ORDER BY login_time DESC");
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
  <a href="attendance-logs-administrator.html">
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
        <input type="text" placeholder="Search" class="search-notification-dashboard" style="margin-right: 10px;">
        <button class="all-btn-report" style="margin-right: 10px;">
          All <img src="/icon/gridicons_dropdown.png" style="width: 25px;">
        </button>
        <button class="today-btn-report" style="margin-right: 10px;">
          Role <img src="/icon/gridicons_dropdown.png" style="width: 25px;">
        </button>
        <button class="today-btn-report" style="margin-right: 10px;">
          Today <img src="/icon/gridicons_dropdown.png" style="width: 25px;">
        </button>
        <button class="month-btn-report" style="margin-right: 10px;">
          Month <img src="/icon/gridicons_dropdown.png" style="width: 25px;">
        </button>
        <button class="day-btn-report" style="margin-right: 10px;">
          Day <img src="/icon/gridicons_dropdown.png" style="width: 25px;">
        </button>
        <button class="year-btn-report" style="margin-right: 200px;">
          Year <img src="/icon/gridicons_dropdown.png" style="width: 25px;">
        </button>
        <button class="print-btn-report-dashboard">
          Print <img src="/icon/🦆 icon _print_.png" style="width: 20px;">
        </button>
      </div>
    </div>

    <div class="contents-attendance-logs-administrator">
      <div class="head-content-attendance-logs-administrator">
        
     
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Role</th>
        <th>Email</th>
        <th>Login Time</th>
        <th>Logout Time</th>
    </tr>
    <?php foreach ($logs as $log): ?>
    <tr>
        <td><?= htmlspecialchars($log['USERID']) ?></td>
        <td><?= htmlspecialchars($log['NAME']) ?></td>
        <td><?= htmlspecialchars($log['ROLE']) ?></td>
        <td><?= htmlspecialchars($log['EMAIL']) ?></td>
        <td><?= htmlspecialchars($log['login_time']) ?></td>
        <td><?= $log['logout_time'] ? htmlspecialchars($log['logout_time']) : 'Still logged in' ?></td>
    </tr>
    <?php endforeach; ?>
</table>
      
      
      
      
    </div>
  </div>
</body>
</html>