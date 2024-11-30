<?php
include('../Conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Input sanitization
        $input_username = htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8');
        $raw_email = $_POST['email'] ?? '';
        $input_email = '';

        // Validate email format
        if (filter_var($raw_email, FILTER_VALIDATE_EMAIL)) {
            $input_email = htmlspecialchars($raw_email, ENT_QUOTES, 'UTF-8');
        } else {
            echo json_encode([
                "emailExists" => true,
                "emailMessage" => "Email is invalid.",
                "usernameExists" => false,
                "usernameMessage" => "Username not checked due to invalid email."
            ]);
            exit();
        }

        $response = [
            "usernameExists" => false,
            "usernameMessage" => "Username is available.",
            "emailExists" => false,
            "emailMessage" => "Email is available."
        ];

        // Prepare SQL statement
        $statement_user = $connpdo->prepare(
            "SELECT USERNAME FROM USERS WHERE USERNAME = :username"
        );

        // Bind parameters
        $statement_user->bindParam(':username', $input_username);

        // Execute the query
        $statement_user->execute();

        // Check if any record exists
        if ($statement_user->rowCount() > 0) {
            $response["usernameExists"] = true;
            $response["usernameMessage"] = "Username already exists.";
        }


        // Prepare SQL statement
        $statement_email = $connpdo->prepare(
            "SELECT EMAIL FROM USERS WHERE  EMAIL = :email"
        );

        // Bind parameters
        $statement_email->bindParam(':email', $input_email);

        // Execute the query
        $statement_email->execute();

        // Check if any record exists
        if ($statement_email->rowCount() > 0) {
            $response["emailExists"] = true;
            $response["emailMessage"] = "Email already exists.";
        }

        return json_encode($response);
    } catch (PDOException $e) {
        echo json_encode(["exists" => true, "message" => "Database error: " . $e->getMessage()]);
    }
}

?>