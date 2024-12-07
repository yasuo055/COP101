<?php
include('../Conn.php');
session_start();

if (isset($_SESSION['USERID'])) {
    $statement = $connpdo->prepare("SELECT EMAIL, CONTACT FROM USERS WHERE USERID = :userid ");
    $statement->bindParam(':userid', $_SESSION['USERID']);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    $statement_levels = $connpdo->prepare("SELECT * FROM SAFE_RANGE WHERE USERID = :userid ");
    $statement_levels->bindParam(':userid', $_SESSION['USERID']);
    $statement_levels->execute();
    $result_lvl = $statement_levels->fetch(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode([
        'session_id' => $_SESSION['USERID'],
        'email' => $result['EMAIL'],
        'contact' => $result['CONTACT'],
        'minPH' => $result_lvl['PH_MIN'],
        'maxPH' => $result_lvl['PH_MAX'],
        'minTEMP' => $result_lvl['TEMP_MIN'],
        'maxTEMP' => $result_lvl['TEMP_MAX'],
        'minNH3' => $result_lvl['AMMONIA_MIN'],
        'maxNH3' => $result_lvl['AMMONIA_MAX'],
        'minDO' => $result_lvl['DO_MIN'],
    ]);
} else {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
}
?>