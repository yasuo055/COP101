<?php
include('Conn.php');

try {
    $stmt = $connpdo->query("SELECT DISTINCT ROLE FROM USERS");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='{$row['ROLE']}'>{$row['ROLE']}</option>";
    }
} catch (PDOException $e) {
    echo "Error fetching roles: " . $e->getMessage();
}
?>
